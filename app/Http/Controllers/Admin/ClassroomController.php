<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Classroom;
use App\Models\Admin\Grade;
use App\Models\Admin\Group;
use App\Models\Admin\Building;
use App\Models\Admin\Room;
use App\Models\Admin\Section;
use Inertia\Inertia;
use Illuminate\Support\Str;

class ClassroomController extends Controller
{
    public function index()
    {
        // Retrieve paginated records from the classrooms table
        $classrooms = Classroom::orderby('name')
            ->with(['building', 'room', 'section', 'grade', 'createdBy', 'updatedBy'])
            ->paginate(10);

        // Pass the paginated data to the Inertia view
        return Inertia::render('Admin/Classrooms/Index', [
            'classrooms' => $classrooms,
        ]);
    }


    public function create()
    {
        // Show the form for create
        $buildings = Building::with(['rooms'])->get();
        $grades = Grade::with(['sections', 'groups'])->get();

        return Inertia::render('Admin/Classrooms/Create', [
            'buildings' => $buildings,
            'grades' => $grades,
        ]);
    }

    public function store(Request $request)
    {

        // Define validation rules
        $validationRules = [
            'building_id' => 'required',
            'room_id' => 'required',
            'grade_id' => 'required',
            'section_id' => 'nullable',
            'group_id' => 'nullable',
        ];

        // Custom error messages for validation
        $customMessages = [
            'building_id.required' => 'Please select a building.',
            'room_id.required' => 'Please select a room.',
            'grade_id.required' => 'Please select a grade.',
        ];


        // Validate the incoming request data
        $validatedData = $request->validate($validationRules, $customMessages);

        // Create a new model and populate it with validated data
        $classroom = new Classroom;
        $classroom->fill($validatedData);

        $classroom->created_by = auth()->id();

        $grade = Grade::find($validatedData['grade_id']);

        if ($grade) {
            $classroom->name = $grade->name;
            $classroom->slug = $grade->slug;
            
            if ($validatedData['section_id']) {
                $section = Section::find($validatedData['section_id']);
                if ($section) {
                    $classroom->name = $classroom->name . "(" . $section->name . ")";
                    $classroom->slug = $classroom->slug . "(" . $section->slug . ")";
                } else {
                    return redirect()->back()->withInput()->with('flash.banner', 'Section does not exist.')->with('flash.bannerStyle', 'danger');
                }
            }
            
            if ($validatedData['group_id']) {
                $group = Group::find($validatedData['group_id']);
                if ($group) {
                    $classroom->name = $classroom->name . "-" . $group->name;
                    $classroom->slug = $classroom->slug . "-" . $group->slug;
                } else {
                    return redirect()->back()->withInput()->with('flash.banner', 'Group does not exist.')->with('flash.bannerStyle', 'danger');
                }
            }

        } else {
            return redirect()->back()->withInput()->with('flash.banner', 'Grade does not exist.')->with('flash.bannerStyle', 'danger');
        }
        // dd($classroom->slug);
        try {
            // Save the model
            if ($classroom->save()) {
                return redirect()->route('admin.classrooms.index')->with('flash.banner', 'Classroom created successfully!');
            } else {
                return redirect()->back()->withInput()->with('flash.banner', 'Failed to create Classroom.')->with('flash.bannerStyle', 'danger');
            }
        } catch (\Exception $e) {
            // Handle the error
            return redirect()->back()->withInput()->with('flash.banner', $e->getMessage())->with('flash.bannerStyle', 'danger');
        }
    }

    public function show(Classroom $classroom)
    {
        // Display a specific one
    }

    public function edit(Classroom $classroom)
    {
        // Show the form for editing
        $buildings = Building::with(['rooms'])->get();
        $grades = Grade::with(['sections', 'groups'])->get();

        // Modify the selected room array to include ID and concatenated name
        $selectedRoom = $classroom->room;
        $modifiedSelectedRoom = [
            'id' => $selectedRoom->id,
            'name' => $selectedRoom->room_no . ' (' . $selectedRoom->name . ')', // Adjust this concatenation to match your room data structure
        ];
        // Pass the paginated data to the Inertia view
        return Inertia::render('Admin/Classrooms/Edit', [
            'classroom' => $classroom,
            'buildings' => $buildings,
            'grades' => $grades,
            'selectedBuilding' => $classroom->building,
            'selectedRoom' => $modifiedSelectedRoom,
            'selectedGrade' => $classroom->grade,
            'selectedSection' => $classroom->section,
            'selectedGroup' => $classroom->group,
        ]);
    }

    public function update(Request $request, Classroom $classroom)
    {

        // Define validation rules
        $validationRules = [
            'building_id' => 'required',
            'room_id' => 'required',
            'grade_id' => 'required',
            'section_id' => 'nullable',
            'group_id' => 'nullable',
        ];

        // Custom error messages for validation
        $customMessages = [
            'building_id.required' => 'Please select a building.',
            'room_id.required' => 'Please select a room.',
            'grade_id.required' => 'Please select a grade.',
        ];

        // Validate the incoming request data
        $validatedData = $request->validate($validationRules, $customMessages);

        // Update the classroom with the validated data
        $classroom->update($validatedData);
        $classroom->updated_by = auth()->id();

        $grade = Grade::find($validatedData['grade_id']);

        if ($grade) {
            $classroom->name = $grade->name;
            $classroom->slug = $grade->slug;
            if ($validatedData['section_id']) {
                $section = Section::find($validatedData['section_id']);
                if ($section) {
                    $classroom->name = $classroom->name . "(" . $section->name . ")";
                    $classroom->slug = $classroom->slug . "(" . $section->slug . ")";
                } else {
                    return redirect()->back()->withInput()->with('flash.banner', 'Section does not exist.')->with('flash.bannerStyle', 'danger');
                }
            }

            if ($validatedData['group_id']) {
                $group = Group::find($validatedData['group_id']);
                if ($group) {
                    $classroom->name = $classroom->name . "-" . $group->name;
                    $classroom->slug = $classroom->slug . "-" . $group->slug;
                } else {
                    return redirect()->back()->withInput()->with('flash.banner', 'Group does not exist.')->with('flash.bannerStyle', 'danger');
                }
            }

        } else {
            return redirect()->back()->withInput()->with('flash.banner', 'Grade does not exist.')->with('flash.bannerStyle', 'danger');
        }
        try {

            // Save the model
            if ($classroom->save()) {
                return redirect()->route('admin.classrooms.index')->with('flash.banner', 'Classroom updated successfully!');
            } else {
                return redirect()->back()->withInput()->with('flash.banner', 'Failed to update Classroom.');
            }
        } catch (\Exception $e) {
            // Handle the error
            return redirect()->back()->withInput()->with('flash.banner', $e->getMessage());
        }
    }


    public function destroy(Classroom $classroom)
    {
        // Delete the classroom
        $classroom->delete();

        // Redirect to the classroom index page with a success message
        return redirect()->route('admin.classrooms.index')->with('flash.banner', 'Classroom deleted successfully!');
    }

    public function status(Request $request, Classroom $classroom)
    {
        if ($request->input('status') === 1) {
            $classroom->status = 0;
            $message = 'Classroom is hidden now!';
        } else {
            $classroom->status = 1;
            $message = 'Classroom is visible to all!';
        }
        $classroom->updated_by = auth()->id();

        if ($classroom->save()) {
            return redirect()->route('admin.classrooms.index')->with('flash.banner', $message);
        } else {
            return redirect()->back()->with('flash.banner', 'Failed to update Visibility.');
        }
    }
}
