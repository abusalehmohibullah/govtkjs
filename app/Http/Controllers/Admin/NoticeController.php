<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Admin\Notice;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class NoticeController extends Controller
{
    public function index()
    {
        // Retrieve paginated records from the notices table
        $notices = Notice::orderby('published_on', 'desc')->paginate(10); // You can adjust the number of records per page (e.g., 10)

        // Pass the paginated data to the Inertia view
        return Inertia::render('Admin/Notices/Index', [
            'notices' => $notices,
        ]);
    }


    public function create()
    {
        // Show the form for create
        return Inertia::render('Admin/Notices/Create');
    }

    public function store(Request $request)
    {
        // dd($request);
        // Define validation rules
        $validationRules = [
            'title' => 'required',
            'content' => 'nullable',
            'attachment' => 'nullable|mimes:pdf,doc,docx,jpg,jpeg,png|max:1024', // 1MB (1024 KB) limit
            'published_on' => 'required|date',
            'scroll' => ['required', Rule::in(['0', '1'])],
        ];

        // Custom error messages for validation
        $customMessages = [
            'title.required' => 'Please provide a title.',
            'attachment.mimes' => 'Invalid file format. Only pdf, doc, docx, jpg, jpeg, png files are allowed.',
            'attachment.max' => 'The attachment must not be larger than 1MB.',
            'published_on.required' => 'Please select the publish date.',
            'scroll.required' => 'Please select an option.',
        ];


        // Validate the incoming request data
        $validatedData = $request->validate($validationRules, $customMessages);

        // Create a new model and populate it with validated data
        $notice = new Notice;
        $notice->fill($validatedData);

        $notice->created_by = auth()->id();

        // Convert the title to a slug
        $notice->slug = Str::slug($validatedData['title']);

        // Check if the slug already exists in the database
        if (Notice::where('slug', $notice->slug)->exists()) {
            // If the slug already exists for a different item,
            // modify the slug to make it unique by appending a count
            $count = 1;
            $originalSlug = $notice->slug;
            while (Notice::where('slug', $notice->slug)->exists()) {
                $notice->slug = $originalSlug . '-' . $count;
                $count++;
            }
        }

        try {
            if ($request->hasFile('attachment')) {
                // dd('gotcha');
                // Get the uploaded file from the request
                $attachment = $request->file('attachment');

                // Validate the file size and type
                if ($attachment->isValid()) {
                    // Generate a unique name for the file based on the slug and the file extension
                    $fileName = $notice->slug . '.' . $attachment->getClientOriginalExtension();

                    // Store the file in the storage directory with the generated name
                    $attachmentPath = $attachment->storeAs('notice-attachments', $fileName, 'public');

                    // Save the file path in the database
                    $notice->attachment = $attachmentPath;
                } else {
                    return redirect()->back()->withInput()->with('flash.banner', 'Failed to upload attachment.');
                }
            }


            // Save the model
            if ($notice->save()) {
                return redirect()->route('admin.notices.index')->with('flash.banner', 'Notice created successfully!');
            } else {
                return redirect()->back()->withInput()->with('flash.banner', 'Failed to create Notice.');
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

        $notice = Notice::findOrFail($id); // You can adjust the number of records per page (e.g., 10)

        // Pass the paginated data to the Inertia view
        return Inertia::render('Admin/Notices/Show', [
            'notice' => $notice,
        ]);
    }

    public function update(Request $request, $id)
    {
        // dd($request);
        // Find the notice by ID
        $notice = Notice::findOrFail($id);
    
        // Define validation rules
        $validationRules = [
            'title' => 'required',
            'content' => 'nullable',
            'attachment' => 'nullable|mimes:pdf,doc,docx,jpg,jpeg,png|max:1024', // 1MB (1024 KB) limit
            'published_on' => 'required|date',
            'scroll' => ['required', Rule::in(['0', '1'])],
        ];
    
        // Custom error messages for validation
        $customMessages = [
            'title.required' => 'Please provide a title.',
            'attachment.mimes' => 'Invalid file format. Only pdf, doc, docx, jpg, jpeg, png files are allowed.',
            'attachment.max' => 'The attachment must not be larger than 1MB.',
            'published_on.required' => 'Please select the publish date.',
            'scroll.required' => 'Please select an option.',
        ];
    
        // Validate the incoming request data
        $validatedData = $request->validate($validationRules, $customMessages);
        
        $oldAttachment = $notice->attachment;
        // Update the notice with the validated data
        $notice->update($validatedData);
        $notice->attachment = $oldAttachment;
        $notice->updated_by = auth()->id();

        // Convert the title to a slug
        $notice->slug = Str::slug($validatedData['title']);

        // Check if the slug already exists in the database
        if (Notice::where('slug', $notice->slug)->exists()) {
            // If the slug already exists for a different item,
            // modify the slug to make it unique by appending a count
            $count = 1;
            $originalSlug = $notice->slug;
            while (Notice::where('slug', $notice->slug)->exists()) {
                $notice->slug = $originalSlug . '-' . $count;
                $count++;
            }
        }

        try {
            if ($request->hasFile('attachment') ) {
                // dd('gotcha');
                // Get the uploaded file from the request
                $attachment = $request->file('attachment');

                // Validate the file size and type
                if ($attachment->isValid()) {
                    // Generate a unique name for the file based on the slug and the file extension
                    $fileName = $notice->slug . '.' . $attachment->getClientOriginalExtension();

                    // Store the file in the storage directory with the generated name
                    $attachmentPath = $attachment->storeAs('notice-attachments', $fileName, 'public');

                    // Save the file path in the database
                    $notice->attachment = $attachmentPath;
                } else {
                    return redirect()->back()->withInput()->with('flash.banner', 'Failed to upload attachment.');
                }
            }


            // Save the model
            if ($notice->save()) {
                return redirect()->route('admin.notices.index')->with('flash.banner', 'Notice updated successfully!');
            } else {
                return redirect()->back()->withInput()->with('flash.banner', 'Failed to update Notice.');
            }
        } catch (\Exception $e) {
            // Handle the error
            return redirect()->back()->withInput()->with('flash.banner', $e->getMessage());
        }
        
    }
    

    public function destroy($id)
    {
        // Find the notice by ID
        $notice = Notice::findOrFail($id);

        // Delete the attachment file if it exists
        if ($notice->attachment) {
            Storage::disk('public')->delete($notice->attachment);
        }

        // Delete the notice
        $notice->delete();

        // Redirect to the notice index page with a success message
        return redirect()->route('admin.notices.index')->with('flash.banner', 'Notice deleted successfully!');
    }
}
