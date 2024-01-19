<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Room;
use App\Models\Admin\Building;
use Inertia\Inertia;
use Illuminate\Support\Str;

class RoomController extends Controller
{
    public function index()
    {
        // Retrieve paginated records from the rooms table
        $rooms = Room::orderby('name')
            ->with(['building', 'createdBy', 'updatedBy'])
            ->paginate(10);

        // Pass the paginated data to the Inertia view
        return Inertia::render('Admin/Rooms/Index', [
            'rooms' => $rooms,
        ]);
    }


    public function create()
    {
        // Show the form for create
        $buildings = Building::orderby('name')->get();

        return Inertia::render('Admin/Rooms/Create', [
            'buildings' => $buildings,
        ]);
    }

    public function store(Request $request)
    {
        // dd($request);
        // Define validation rules
        $validationRules = [
            'building_id' => 'required',
            'room_no' => 'required',
            // 'name' => 'required|unique:rooms',
            'name' => 'nullable',
            'student_capacity' => 'nullable',
            'examinee_capacity' => 'nullable',
        ];

        // Custom error messages for validation
        $customMessages = [
            'building_id.required' => 'Please select a building.',
            'room_no.required' => 'Please provide a room_no.',
            // 'name.required' => 'Please provide a name.',
            // 'name.unique' => 'This Room already exists.',
        ];


        // Validate the incoming request data
        $validatedData = $request->validate($validationRules, $customMessages);

        // Create a new model and populate it with validated data
        $room = new Room;
        $room->fill($validatedData);

        $room->created_by = auth()->id();

        $building = Building::find($validatedData['building_id']);

        if ($building) {
            $room->slug = $building->slug. '#' . $validatedData['room_no'];
        } else {
            return redirect()->back()->withInput()->with('flash.banner', 'Building does not exist.')->with('flash.bannerStyle', 'danger');
        }

        try {
            // Save the model
            if ($room->save()) {
                return redirect()->route('admin.rooms.index')->with('flash.banner', 'Room created successfully!');
            } else {
                return redirect()->back()->withInput()->with('flash.banner', 'Failed to create Room.')->with('flash.bannerStyle', 'danger');
            }
        } catch (\Exception $e) {
            // Handle the error
            return redirect()->back()->withInput()->with('flash.banner', $e->getMessage())->with('flash.bannerStyle', 'danger');
        }
    }

    public function show(Room $room)
    {
        // Display a specific one
    }

    public function edit(Room $room)
    {
        // Show the form for editing
        // dd($room->building);
        $buildings = Building::orderby('name')->get();
        // Pass the paginated data to the Inertia view
        return Inertia::render('Admin/Rooms/Edit', [
            'room' => $room,
            'buildings' => $buildings,
            'selectedBuilding' => $room->building,
        ]);
    }

    public function update(Request $request, Room $room)
    {
        $validationRules = [
            'building_id' => 'required',
            'room_no' => 'required',
            // 'name' => 'required|unique:rooms',
            'name' => 'nullable',
            'student_capacity' => 'nullable',
            'examinee_capacity' => 'nullable',
        ];

        // Custom error messages for validation
        $customMessages = [
            'building_id.required' => 'Please select a building.',
            'room_no.required' => 'Please provide a room_no.',
            // 'name.required' => 'Please provide a name.',
            // 'name.unique' => 'This Room already exists.',
        ];

        // Validate the incoming request data
        $validatedData = $request->validate($validationRules, $customMessages);

        // Update the room with the validated data
        $room->update($validatedData);
        $room->updated_by = auth()->id();


        $building = Building::find($validatedData['building_id']);

        if ($building) {
            $room->slug = $building->slug. '#' . $validatedData['room_no'];
        } else {
            return redirect()->back()->withInput()->with('flash.banner', 'Building does not exist.')->with('flash.bannerStyle', 'danger');
        }

        try {

            // Save the model
            if ($room->save()) {
                return redirect()->route('admin.rooms.index')->with('flash.banner', 'Room updated successfully!');
            } else {
                return redirect()->back()->withInput()->with('flash.banner', 'Failed to update Room.');
            }
        } catch (\Exception $e) {
            // Handle the error
            return redirect()->back()->withInput()->with('flash.banner', $e->getMessage());
        }
    }


    public function destroy(Room $room)
    {
        // Delete the attachment file if it exists

        // Delete the room
        $room->delete();

        // Redirect to the room index page with a success message
        return redirect()->route('admin.rooms.index')->with('flash.banner', 'Room deleted successfully!');
    }

    public function status(Request $request, Room $room)
    {
        if ($request->input('status') === 1) {
            $room->status = 0;
            $message = 'Room is hidden now!';
        } else {
            $room->status = 1;
            $message = 'Room is visible to all!';
        }
        $room->updated_by = auth()->id();

        if ($room->save()) {
            return redirect()->route('admin.rooms.index')->with('flash.banner', $message);
        } else {
            return redirect()->back()->with('flash.banner', 'Failed to update Visibility.');
        }
    }
}
