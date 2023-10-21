<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Section;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;

class SectionController extends Controller
{
    public function index()
    {
        // Retrieve paginated records from the sections table
        $sections = Section::orderby('name')
        ->with(['createdBy', 'updatedBy'])
        ->paginate(10);

        // Pass the paginated data to the Inertia view
        return Inertia::render('Admin/Sections/Index', [
            'sections' => $sections,
        ]);
    }


    public function create()
    {
        // Show the form for create
        return Inertia::render('Admin/Sections/Create');
    }

    public function store(Request $request)
    {
        // dd($request);
        // Define validation rules
        $validationRules = [
            'name' => 'required|unique:sections',
        ];

        // Custom error messages for validation
        $customMessages = [
            'name.required' => 'Please provide a name.',
            'name.unique' => 'This Section already exists.',
        ];


        // Validate the incoming request data
        $validatedData = $request->validate($validationRules, $customMessages);

        // Create a new model and populate it with validated data
        $section = new Section;
        $section->fill($validatedData);

        $section->created_by = auth()->id();

        // Convert the name to a slug
        $section->slug = Str::slug($validatedData['name']);

        try {
            // Save the model
            if ($section->save()) {
                return redirect()->route('admin.sections.index')->with('flash.banner', 'Section created successfully!');
            } else {
                return redirect()->back()->withInput()->with('flash.banner', 'Failed to create Section.')->with('flash.bannerStyle', 'danger');
            }
        } catch (\Exception $e) {
            // Handle the error
            return redirect()->back()->withInput()->with('flash.banner', $e->getMessage())->with('flash.bannerStyle', 'danger');
        }
    }

    public function show($id)
    {
        // Display a specific one
    }

    public function edit($id)
    {
        // Show the form for editing

        $section = Section::findOrFail($id); // You can adjust the number of records per page (e.g., 10)

        // Pass the paginated data to the Inertia view
        return Inertia::render('Admin/Sections/Show', [
            'section' => $section,
        ]);
    }

    public function update(Request $request, $id)
    {
        // dd($request);
        // Find the section by ID
        $section = Section::findOrFail($id);

        // Define validation rules
        $validationRules = [
            'name' => 'required|unique:sections,name,' . $id,
        ];

        // Custom error messages for validation
        $customMessages = [
            'name.required' => 'Please provide a name.',
            'name.unique' => 'This Section already exists.',
        ];

        // Validate the incoming request data
        $validatedData = $request->validate($validationRules, $customMessages);

        $oldAttachment = $section->attachment;
        // Update the section with the validated data
        $section->update($validatedData);
        $section->updated_by = auth()->id();

        // Convert the name to a slug
        $section->slug = Str::slug($validatedData['name']);

        try {

            // Save the model
            if ($section->save()) {
                return redirect()->route('admin.sections.index')->with('flash.banner', 'Section updated successfully!');
            } else {
                return redirect()->back()->withInput()->with('flash.banner', 'Failed to update Section.');
            }
        } catch (\Exception $e) {
            // Handle the error
            return redirect()->back()->withInput()->with('flash.banner', $e->getMessage());
        }
    }


    public function destroy($id)
    {
        // Find the section by ID
        $section = Section::findOrFail($id);

        // Delete the attachment file if it exists

        // Delete the section
        $section->delete();

        // Redirect to the section index page with a success message
        return redirect()->route('admin.sections.index')->with('flash.banner', 'Section deleted successfully!');
    }

    public function status(Request $request, Section $section)
    {
        if ($request->input('status') === 1) {
            $section->status = 0;
            $message = 'Section is hidden now!';
        } else {
            $section->status = 1;
            $message = 'Section is visible to all!';
        }
        $section->updated_by = auth()->id();

        if ($section->save()) {
            return redirect()->route('admin.sections.index')->with('flash.banner', $message);
        } else {
            return redirect()->back()->with('flash.banner', 'Failed to update Visibility.');
        }
    }
}
