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
        $faqs = Faq::orderby('priority')
            ->with(['createdBy', 'updatedBy'])
            ->paginate(10);

        // Pass the paginated data to the Inertia view
        return Inertia::render('Admin/Faqs/Index', [
            'faqs' => $faqs,
        ]);
    }


    public function create()
    {
        // Retrieve all faqs to get the current priorities
        $faqs = Faq::orderBy('priority')->get();

        // Extract current priorities into an array
        $currentPriorities = $faqs->pluck('priority')->toArray();

        // Add one more priority to the end
        $currentPriorities[] = count($currentPriorities) + 1;

        // Transform current priorities into an array of objects with 'id' and 'name'
        $priorities = array_map(function ($priority) {
            return ['id' => $priority, 'name' => $this->ordinal($priority)];
        }, $currentPriorities);

        // Show the form for create
        return Inertia::render('Admin/Faqs/Create', [
            'priorities' => $priorities,
        ]);
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
        // Set the priority based on the user's selection or default to the last priority
        $selectedPriority = $request->input('priority');

        // Retrieve all faqs to get the current priorities
        $faqs = Faq::orderBy('priority')->get();

        // Extract current priorities into an array
        $currentPriorities = $faqs->pluck('priority')->toArray();

        $conflictingIndex = array_search($selectedPriority, $currentPriorities);

        // If conflicting index is found, adjust priorities
        if ($conflictingIndex !== false) {
            // Increment the priorities of items after the conflicting one
            for ($i = $conflictingIndex; $i < count($currentPriorities); $i++) {
                $currentPriorities[$i]++;
            }
            // dd($currentPriorities);
            // Update priorities for all faqs
            foreach ($faqs as $index => $faqItem) {
                $faqItem->priority = $currentPriorities[$index];
                $faqItem->save();
            }
        }

        // Set the priority for the current faq
        $faq->priority = $selectedPriority;
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

        // Retrieve all faqs to get the current priorities
        $faqs = Faq::orderBy('priority')->get();

        // Extract current priorities into an array
        $currentPriorities = $faqs->pluck('priority')->toArray();

        // Transform current priorities into an array of objects with 'id' and 'name'
        $priorities = array_map(function ($priority) {
            return ['id' => $priority, 'name' => $this->ordinal($priority)];
        }, $currentPriorities);
        // Pass the paginated data to the Inertia view
        return Inertia::render('Admin/Faqs/Edit', [
            'faq' => $faq,
            'priorities' => $priorities,
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

        // Update the faq with the validated data
        $faq->update($validatedData);
        $faq->updated_by = auth()->id();

        // Set the priority based on the user's selection or default to the last priority
        $selectedPriority = $request->input('priority');

        // Retrieve all faqs to get the current priorities
        $faqs = Faq::orderBy('priority')->get();

        // Extract current priorities into an array
        $currentPriorities = $faqs->pluck('priority')->toArray();

        $conflictingIndex = array_search($selectedPriority, $currentPriorities);

        // If conflicting index is found, adjust priorities
        if ($conflictingIndex !== false && $selectedPriority !== $faq->priority) {
            // dd('chk3');
            // Increment the priorities of items after the conflicting one

            if ($faq->priority > $selectedPriority) {
                // dd('+');
                for ($i = $conflictingIndex; $i < $faq->priority; $i++) {
                    $currentPriorities[$i]++;
                }
            } else {
                // dd('-');
                for ($i = $conflictingIndex; $i > $faq->priority - 1; $i--) {
                    $currentPriorities[$i]--;
                }
            }


            // dd($currentPriorities);
            // Update priorities for all faqs
            foreach ($faqs as $index => $faqItem) {
                $faqItem->priority = $currentPriorities[$index];
                $faqItem->save();
            }
        }

        // Set the priority for the current faq
        $faq->priority = $selectedPriority;

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


        // Set the priority based on the user's selection or default to the last priority
        $selectedPriority = $faq->priority;

        // Retrieve all faqs to get the current priorities
        $faqs = Faq::orderBy('priority')->get();

        // Extract current priorities into an array
        $currentPriorities = $faqs->pluck('priority')->toArray();

        $conflictingIndex = array_search($selectedPriority, $currentPriorities);

        // If conflicting index is found, adjust priorities
        if ($conflictingIndex !== false) {


            // Increment the priorities of items after the conflicting one
            for ($i = $conflictingIndex; $i < count($currentPriorities); $i++) {
                $currentPriorities[$i]--;
            }
            // Update priorities for all faqs
            foreach ($faqs as $index => $faqItem) {
                $faqItem->priority = $currentPriorities[$index];
                $faqItem->save();
            }
        }


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

    private function ordinal($number)
    {
        $suffix = ['th', 'st', 'nd', 'rd', 'th', 'th', 'th', 'th', 'th', 'th'];
        if (($number % 100) >= 11 && ($number % 100) <= 13) {
            return $number . 'th';
        } else {
            return $number . $suffix[$number % 10];
        }
    }
}
