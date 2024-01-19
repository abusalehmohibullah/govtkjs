<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin\Teacher;
use App\Models\Admin\Classroom;
use App\Models\Admin\Subject;
use Inertia\Inertia;
use Illuminate\Support\Str;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve paginated records from the teachers table
        $teachers = Teacher::with(['user', 'subject', 'classroom', 'createdBy', 'updatedBy'])
            ->paginate(10);

        // Pass the paginated data to the Inertia view
        return Inertia::render('Admin/Teachers/Index', [
            'teachers' => $teachers,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::orderBy('name')->doesntHave('teacher')->get();
        $classrooms = Classroom::doesntHave('teacher')->orderBy('name')->get();
        $subjects = Subject::orderBy('code')->get();

        // Show the form for create
        return Inertia::render('Admin/Teachers/Create', [
            'users' => $users,
            'classrooms' => $classrooms,
            'subjects' => $subjects,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        // Define validation rules
        $validationRules = [
            'user_id' => 'required|unique:teachers',
            'unique_id' => 'nullable|unique:teachers',
            'designation' => 'required',
            'priority' => 'nullable',
            'subject_id' => 'nullable',
            'classroom_id' => 'nullable',
        ];

        // Custom error messages for validation
        $customMessages = [
            'user_id.required' => 'Please select a user.',
            'user_id.unique' => 'This user already exists.',
            'unique_id.unique' => 'This ID already exists.',
            'designation.required' => 'Please select a designation.',
        ];


        // Validate the incoming request data
        $validatedData = $request->validate($validationRules, $customMessages);

        // Create a new model and populate it with validated data
        $teacher = new Teacher;
        $teacher->fill($validatedData);

        $teacher->created_by = auth()->id();

        try {
            // Save the model
            if ($teacher->save()) {
                return redirect()->route('admin.teachers.index')->with('flash.banner', 'Teacher created successfully!');
            } else {
                return redirect()->back()->withInput()->with('flash.banner', 'Failed to create Teacher.')->with('flash.bannerStyle', 'danger');
            }
        } catch (\Exception $e) {
            // Handle the error
            return redirect()->back()->withInput()->with('flash.banner', $e->getMessage())->with('flash.bannerStyle', 'danger');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Teacher $teacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Teacher $teacher)
    {
        $users = User::orderBy('name')->get();
        $classrooms = Classroom::orderBy('name')->get();
        $subjects = Subject::orderBy('code')->get();

        // Show the form for create
        return Inertia::render('Admin/Teachers/Edit', [
            'users' => $users,
            'classrooms' => $classrooms,
            'subjects' => $subjects,
            'teacher' => $teacher,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Teacher $teacher)
    {
        // dd($request);
        // Define validation rules
        $validationRules = [
            'user_id' => 'required|unique:teachers,user_id,' . $teacher->id,
            'unique_id' => 'nullable|unique:teachers,unique_id,' . $teacher->id,
            'designation' => 'required',
            'priority' => 'nullable',
            'subject_id' => 'nullable',
            'classroom_id' => 'nullable',
        ];

        // Custom error messages for validation
        $customMessages = [
            'user_id.required' => 'Please select a user.',
            'user_id.unique' => 'This user already exists.',
            'unique_id.unique' => 'This ID already exists.',
            'designation.required' => 'Please select a designation.',
        ];


        // Validate the incoming request data
        $validatedData = $request->validate($validationRules, $customMessages);

        $teacher->update($validatedData);

        $teacher->created_by = auth()->id();

        try {
            // Save the model
            if ($teacher->save()) {
                return redirect()->route('admin.teachers.index')->with('flash.banner', 'Teacher update successfully!');
            } else {
                return redirect()->back()->withInput()->with('flash.banner', 'Failed to update Teacher.')->with('flash.bannerStyle', 'danger');
            }
        } catch (\Exception $e) {
            // Handle the error
            return redirect()->back()->withInput()->with('flash.banner', $e->getMessage())->with('flash.bannerStyle', 'danger');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Teacher $teacher)
    {
        // Delete the teacher
        $teacher->delete();

        // Redirect to the teacher index page with a success message
        return redirect()->route('admin.teachers.index')->with('flash.banner', 'Teacher deleted successfully!');
    }
}
