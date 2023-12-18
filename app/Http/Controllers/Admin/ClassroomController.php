<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Classroom;
use App\Models\Admin\Grade;
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
            ->with(['room', 'section', 'grade', 'createdBy', 'updatedBy'])
            ->paginate(10);

        // Pass the paginated data to the Inertia view
        return Inertia::render('Admin/Classrooms/Index', [
            'classrooms' => $classrooms,
        ]);
    }


    public function create()
    {
        // Show the form for create
        $buildings = Building::with(['room']);
        $rooms = Room::orderby('name')->get();
        $sections = Section::orderby('name')->get();
        $grades = Grade::orderby('name')->get();

        return Inertia::render('Admin/Classrooms/Create', [
            'buildings' => $buildings,
            // 'rooms' => $rooms,
            'sections' => $sections,
            'grades' => $grades,
        ]);
    }

    public function store(Request $request)
    {
        // dd($request);
        // Define validation rules
        $validationRules = [
            'building_id' => 'required',
            'classroom_no' => 'required',
            // 'name' => 'required|unique:classrooms',
            'name' => 'nullable',
            'student_capacity' => 'nullable',
            'examinee_capacity' => 'nullable',
        ];

        // Custom error messages for validation
        $customMessages = [
            'building_id.required' => 'Please select a building.',
            'classroom_no.required' => 'Please provide a classroom_no.',
            // 'name.required' => 'Please provide a name.',
            // 'name.unique' => 'This Classroom already exists.',
        ];


        // Validate the incoming request data
        $validatedData = $request->validate($validationRules, $customMessages);

        // Create a new model and populate it with validated data
        $classroom = new Classroom;
        $classroom->fill($validatedData);

        $classroom->created_by = auth()->id();

        $building = Building::find($validatedData['building_id']);

        if ($building) {
            $classroom->slug = $building->slug. '#' . $validatedData['classroom_no'];
        } else {
            return redirect()->back()->withInput()->with('flash.banner', 'Building does not exist.')->with('flash.bannerStyle', 'danger');
        }

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
        // dd($classroom->building);
        $buildings = Building::orderby('name')->get();
        // Pass the paginated data to the Inertia view
        return Inertia::render('Admin/Classrooms/Show', [
            'classroom' => $classroom,
            'buildings' => $buildings,
            'selectedBuilding' => $classroom->building,
        ]);
    }

    public function update(Request $request, Classroom $classroom)
    {
        $validationRules = [
            'building_id' => 'required',
            'classroom_no' => 'required',
            // 'name' => 'required|unique:classrooms',
            'name' => 'nullable',
            'student_capacity' => 'nullable',
            'examinee_capacity' => 'nullable',
        ];

        // Custom error messages for validation
        $customMessages = [
            'building_id.required' => 'Please select a building.',
            'classroom_no.required' => 'Please provide a classroom_no.',
            // 'name.required' => 'Please provide a name.',
            // 'name.unique' => 'This Classroom already exists.',
        ];

        // Validate the incoming request data
        $validatedData = $request->validate($validationRules, $customMessages);

        // Update the classroom with the validated data
        $classroom->update($validatedData);
        $classroom->updated_by = auth()->id();


        $building = Building::find($validatedData['building_id']);

        if ($building) {
            $classroom->slug = $building->slug. '#' . $validatedData['classroom_no'];
        } else {
            return redirect()->back()->withInput()->with('flash.banner', 'Building does not exist.')->with('flash.bannerStyle', 'danger');
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
        // Delete the attachment file if it exists

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
