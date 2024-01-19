<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Grade;
use App\Models\Admin\Section;
use App\Models\Admin\Group;
use App\Models\Admin\Subject;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;

class GradeController extends Controller
{
    public function index()
    {
        // Retrieve paginated records from the grades table
        $grades = Grade::orderby('name')
            ->with(['sections', 'groups', 'subjects', 'createdBy', 'updatedBy'])
            ->paginate(10);

        // Pass the paginated data to the Inertia view
        return Inertia::render('Admin/Grades/Index', [
            'grades' => $grades,
        ]);
    }


    public function create()
    {
        $sections = Section::get();
        $groups = Group::get();
        $subjects = Subject::get();

        // Show the form for create
        return Inertia::render('Admin/Grades/Create', [
            'sections' => $sections,
            'groups' => $groups,
            'subjects' => $subjects,
        ]);
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
                $grade->groups()->attach($request->input('selectedGroups', []));
                $grade->sections()->attach($request->input('selectedSections', []));
                $grade->subjects()->attach($request->input('selectedSubjects', []));
                return redirect()->route('admin.grades.index')->with('flash.banner', 'Grade created successfully!');
            } else {
                return redirect()->back()->withInput()->with('flash.banner', 'Failed to create Grade.')->with('flash.bannerStyle', 'danger');
            }
        } catch (\Exception $e) {
            // Handle the error
            return redirect()->back()->withInput()->with('flash.banner', $e->getMessage())->with('flash.bannerStyle', 'danger');
        }
    }

    public function show(Grade $grade)
    {
        // Display a specific one
    }

    public function edit(Grade $grade)
    {
        $sections = Section::get();
        $selectedSection = $grade->sections;
        $groups = Group::get();
        $selectedGroup = $grade->groups;
        $subjects = Subject::get();
        $selectedSubject = $grade->subjects;
        // Show the form for editing
        // Pass the paginated data to the Inertia view
        return Inertia::render('Admin/Grades/Edit', [
            'grade' => $grade,
            'sections' => $sections,
            'selectedSection' => $selectedSection,
            'groups' => $groups,
            'selectedGroup' => $selectedGroup,
            'subjects' => $subjects,
            'selectedSubject' => $selectedSubject,
        ]);
    }

    public function update(Request $request, Grade $grade)
    {
        // dd($request);

        // Define validation rules
        $validationRules = [
            'name' => 'required|unique:grades,name,' . $grade->id,
        ];

        // Custom error messages for validation
        $customMessages = [
            'name.required' => 'Please provide a name.',
            'name.unique' => 'This Grade already exists.',
        ];

        // Validate the incoming request data
        $validatedData = $request->validate($validationRules, $customMessages);

        // Update the grade with the validated data
        $grade->update($validatedData);
        $grade->updated_by = auth()->id();

        // Convert the name to a slug
        $grade->slug = Str::slug($validatedData['name']);

        try {
            // Save the model
            if ($grade->save()) {
                $grade->groups()->sync($request->input('selectedGroups', []));
                $grade->sections()->sync($request->input('selectedSections', []));
                $grade->subjects()->sync($request->input('selectedSubjects', []));
                return redirect()->route('admin.grades.index')->with('flash.banner', 'Grade updated successfully!');
            } else {
                return redirect()->back()->withInput()->with('flash.banner', 'Failed to update Grade.');
            }
        } catch (\Exception $e) {
            // Handle the error
            return redirect()->back()->withInput()->with('flash.banner', $e->getMessage());
        }
    }


    public function destroy(Grade $grade)
    {
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
