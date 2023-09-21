<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Subject;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;

class SubjectController extends Controller
{
    public function index()
    {
        // Retrieve paginated records from the subjects table
        $subjects = Subject::orderby('name')->paginate(10); // You can adjust the number of records per page (e.g., 10)

        // Pass the paginated data to the Inertia view
        return Inertia::render('Admin/Subjects/Index', [
            'subjects' => $subjects,
        ]);
    }


    public function create()
    {
        // Show the form for create
        return Inertia::render('Admin/Subjects/Create');
    }

    public function store(Request $request)
    {
        // dd($request);
        // Define validation rules
        $validationRules = [
            'name' => 'required|unique:subjects',
            'code' => 'required',
        ];

        // Custom error messages for validation
        $customMessages = [
            'name.required' => 'Please provide a name.',
            'name.unique' => 'This Subject already exists.',
            'code.required' => 'Please provide a subject code.',
        ];


        // Validate the incoming request data
        $validatedData = $request->validate($validationRules, $customMessages);

        // Create a new model and populate it with validated data
        $subject = new Subject;
        $subject->fill($validatedData);

        $subject->created_by = auth()->id();

        // Convert the name to a slug
        $subject->slug = Str::slug($validatedData['name']);

        try {
            // Save the model
            if ($subject->save()) {
                return redirect()->route('admin.subjects.index')->with('flash.banner', 'Subject created successfully!');
            } else {
                return redirect()->back()->withInput()->with('flash.banner', 'Failed to create Subject.')->with('flash.bannerStyle', 'danger');
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

        $subject = Subject::findOrFail($id); // You can adjust the number of records per page (e.g., 10)

        // Pass the paginated data to the Inertia view
        return Inertia::render('Admin/Subjects/Show', [
            'subject' => $subject,
        ]);
    }

    public function update(Request $request, $id)
    {
        // dd($request);
        // Find the subject by ID
        $subject = Subject::findOrFail($id);

        // Define validation rules
        $validationRules = [
            'name' => 'required|unique:subjects,name,' . $id,
            'code' => 'required',
        ];

        // Custom error messages for validation
        $customMessages = [
            'name.required' => 'Please provide a name.',
            'name.unique' => 'This Subject already exists.',
            'code.required' => 'Please provide a subject code.',
        ];

        // Validate the incoming request data
        $validatedData = $request->validate($validationRules, $customMessages);

        $oldAttachment = $subject->attachment;
        // Update the subject with the validated data
        $subject->update($validatedData);
        $subject->updated_by = auth()->id();

        // Convert the name to a slug
        $subject->slug = Str::slug($validatedData['name']);

        try {

            // Save the model
            if ($subject->save()) {
                return redirect()->route('admin.subjects.index')->with('flash.banner', 'Subject updated successfully!');
            } else {
                return redirect()->back()->withInput()->with('flash.banner', 'Failed to update Subject.');
            }
        } catch (\Exception $e) {
            // Handle the error
            return redirect()->back()->withInput()->with('flash.banner', $e->getMessage());
        }
    }


    public function destroy($id)
    {
        // Find the subject by ID
        $subject = Subject::findOrFail($id);

        // Delete the attachment file if it exists

        // Delete the subject
        $subject->delete();

        // Redirect to the subject index page with a success message
        return redirect()->route('admin.subjects.index')->with('flash.banner', 'Subject deleted successfully!');
    }
}
