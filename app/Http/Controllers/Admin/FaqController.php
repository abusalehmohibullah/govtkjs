<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Admin\Faq;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class FaqController extends Controller
{
    public function index()
    {
        // Retrieve paginated records from the faqs table
        $faqs = Faq::orderby('created_at', 'desc')
        ->with(['createdBy', 'updatedBy'])
        ->paginate(10);

        // Pass the paginated data to the Inertia view
        return Inertia::render('Admin/Faqs/Index', [
            'faqs' => $faqs,
        ]);
    }


    public function create()
    {
        // Show the form for create
        return Inertia::render('Admin/Faqs/Create');
    }

    public function store(Request $request)
    {
        // dd($request);
        // Define validation rules
        $validationRules = [
            'question' => 'required',
            'answer' => 'required',
        ];

        // Custom error messages for validation
        $customMessages = [
            'question.required' => 'Please provide a question.',
            'answer.required' => 'Please provide an answer.',
        ];


        // Validate the incoming request data
        $validatedData = $request->validate($validationRules, $customMessages);

        // Create a new model and populate it with validated data
        $faq = new Faq;
        $faq->fill($validatedData);

        $faq->created_by = auth()->id();

        // Convert the question to a slug
        $faq->slug = Str::slug($validatedData['question']);

        // Check if the slug already exists in the database
        if (Faq::where('slug', $faq->slug)->exists()) {
            // If the slug already exists for a different item,
            // modify the slug to make it unique by appending a count
            $count = 1;
            $originalSlug = $faq->slug;
            while (Faq::where('slug', $faq->slug)->exists()) {
                $faq->slug = $originalSlug . '-' . $count;
                $count++;
            }
        }

        try {
            // Save the model
            if ($faq->save()) {
                return redirect()->route('admin.faqs.index')->with('flash.banner', 'FAQ created successfully!');
            } else {
                return redirect()->back()->withInput()->with('flash.banner', 'Failed to create FAQ.');
            }
        } catch (\Exception $e) {
            // Handle the error
            return redirect()->back()->withInput()->with('flash.banner', $e->getMessage());
        }
    }

    public function show($id)
    {
        // Display a specific one
    }

    public function edit($id)
    {
        // Show the form for editing

        $faq = Faq::findOrFail($id); // You can adjust the number of records per page (e.g., 10)

        // Pass the paginated data to the Inertia view
        return Inertia::render('Admin/Faqs/Show', [
            'faq' => $faq,
        ]);
    }

    public function update(Request $request, $id)
    {
        // dd($request);
        // Find the faq by ID
        $faq = Faq::findOrFail($id);
    
        // Define validation rules
        $validationRules = [
            'question' => 'required',
            'answer' => 'required',
        ];

        // Custom error messages for validation
        $customMessages = [
            'question.required' => 'Please provide a question.',
            'answer.required' => 'Please provide an answer.',
        ];
    
        // Validate the incoming request data
        $validatedData = $request->validate($validationRules, $customMessages);
        
        $oldAttachment = $faq->attachment;
        // Update the faq with the validated data
        $faq->update($validatedData);
        $faq->updated_by = auth()->id();

        // Convert the question to a slug
        $faq->slug = Str::slug($validatedData['question']);

        // Check if the slug already exists in the database
        if (Faq::where('slug', $faq->slug)->exists()) {
            // If the slug already exists for a different item,
            // modify the slug to make it unique by appending a count
            $count = 1;
            $originalSlug = $faq->slug;
            while (Faq::where('slug', $faq->slug)->exists()) {
                $faq->slug = $originalSlug . '-' . $count;
                $count++;
            }
        }

        try {

            // Save the model
            if ($faq->save()) {
                return redirect()->route('admin.faqs.index')->with('flash.banner', 'FAQ updated successfully!');
            } else {
                return redirect()->back()->withInput()->with('flash.banner', 'Failed to update FAQ.');
            }
        } catch (\Exception $e) {
            // Handle the error
            return redirect()->back()->withInput()->with('flash.banner', $e->getMessage());
        }
        
    }
    

    public function destroy($id)
    {
        // Find the faq by ID
        $faq = Faq::findOrFail($id);

        // Delete the attachment file if it exists

        // Delete the faq
        $faq->delete();

        // Redirect to the faq index page with a success message
        return redirect()->route('admin.faqs.index')->with('flash.banner', 'FAQ deleted successfully!');
    }

    public function status(Request $request, Faq $faq)
    {
        if ($request->input('status') === 1) {
            $faq->status = 0;
            $message = 'FAQ is hidden now!';
        } else {
            $faq->status = 1;
            $message = 'FAQ is visible to all!';
        }
        $faq->updated_by = auth()->id();

        if ($faq->save()) {
            return redirect()->route('admin.faqs.index')->with('flash.banner', $message);
        } else {
            return redirect()->back()->with('flash.banner', 'Failed to update Visibility.');
        }
    }
}
