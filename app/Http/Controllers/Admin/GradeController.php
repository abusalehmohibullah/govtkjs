<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Grade;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;

class GradeController extends Controller
{
    public function index()
    {
        // Retrieve paginated records from the grades table
        $grades = Grade::orderby('name')
        ->with(['createdBy', 'updatedBy'])
        ->paginate(10);

        // Pass the paginated data to the Inertia view
        return Inertia::render('Admin/Grades/Index', [
            'grades' => $grades,
        ]);
    }


    public function create()
    {
        // Show the form for create
        return Inertia::render('Admin/Grades/Create');
    }

    public function store(Request $request)
    {
        // dd($request);
        // Define validation rules
        $validationRules = [
            'name' => 'required|unique:grades',
        ];

        // Custom error messages for validation
        $customMessages = [
            'name.required' => 'Please provide a name.',
            'name.unique' => 'This Grade already exists.',
        ];


        // Validate the incoming request data
        $validatedData = $request->validate($validationRules, $customMessages);

        // Create a new model and populate it with validated data
        $grade = new Grade;
        $grade->fill($validatedData);

        $grade->created_by = auth()->id();

        // Convert the name to a slug
        $grade->slug = Str::slug($validatedData['name']);

        try {
            // Save the model
            if ($grade->save()) {
                return redirect()->route('admin.grades.index')->with('flash.banner', 'Grade created successfully!');
            } else {
                return redirect()->back()->withInput()->with('flash.banner', 'Failed to create Grade.')->with('flash.bannerStyle', 'danger');
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

        $grade = Grade::findOrFail($id); // You can adjust the number of records per page (e.g., 10)

        // Pass the paginated data to the Inertia view
        return Inertia::render('Admin/Grades/Show', [
            'grade' => $grade,
        ]);
    }

    public function update(Request $request, $id)
    {
        // dd($request);
        // Find the grade by ID
        $grade = Grade::findOrFail($id);

        // Define validation rules
        $validationRules = [
            'name' => 'required|unique:grades,name,' . $id,
        ];

        // Custom error messages for validation
        $customMessages = [
            'name.required' => 'Please provide a name.',
            'name.unique' => 'This Grade already exists.',
        ];

        // Validate the incoming request data
        $validatedData = $request->validate($validationRules, $customMessages);

        $oldAttachment = $grade->attachment;
        // Update the grade with the validated data
        $grade->update($validatedData);
        $grade->updated_by = auth()->id();

        // Convert the name to a slug
        $grade->slug = Str::slug($validatedData['name']);

        try {

            // Save the model
            if ($grade->save()) {
                return redirect()->route('admin.grades.index')->with('flash.banner', 'Grade updated successfully!');
            } else {
                return redirect()->back()->withInput()->with('flash.banner', 'Failed to update Grade.');
            }
        } catch (\Exception $e) {
            // Handle the error
            return redirect()->back()->withInput()->with('flash.banner', $e->getMessage());
        }
    }


    public function destroy($id)
    {
        // Find the grade by ID
        $grade = Grade::findOrFail($id);

        // Delete the attachment file if it exists

        // Delete the grade
        $grade->delete();

        // Redirect to the grade index page with a success message
        return redirect()->route('admin.grades.index')->with('flash.banner', 'Grade deleted successfully!');
    }

    public function status(Request $request, Grade $grade)
    {
        if ($request->input('status') === 1) {
            $grade->status = 0;
            $message = 'Grade is hidden now!';
        } else {
            $grade->status = 1;
            $message = 'Grade is visible to all!';
        }
        $grade->updated_by = auth()->id();

        if ($grade->save()) {
            return redirect()->route('admin.grades.index')->with('flash.banner', $message);
        } else {
            return redirect()->back()->with('flash.banner', 'Failed to update Visibility.');
        }
    }
}
