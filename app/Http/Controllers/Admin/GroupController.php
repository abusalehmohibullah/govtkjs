<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Group;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;

class GroupController extends Controller
{
    public function index()
    {
        // Retrieve paginated records from the groups table
        $groups = Group::orderby('name')
        ->with(['createdBy', 'updatedBy'])
        ->paginate(10);

        // Pass the paginated data to the Inertia view
        return Inertia::render('Admin/Groups/Index', [
            'groups' => $groups,
        ]);
    }


    public function create()
    {
        // Show the form for create
        return Inertia::render('Admin/Groups/Create');
    }

    public function store(Request $request)
    {
        // dd($request);
        // Define validation rules
        $validationRules = [
            'name' => 'required|unique:groups',
        ];

        // Custom error messages for validation
        $customMessages = [
            'name.required' => 'Please provide a name.',
            'name.unique' => 'This Group already exists.',
        ];


        // Validate the incoming request data
        $validatedData = $request->validate($validationRules, $customMessages);

        // Create a new model and populate it with validated data
        $group = new Group;
        $group->fill($validatedData);

        $group->created_by = auth()->id();

        // Convert the name to a slug
        $group->slug = Str::slug($validatedData['name']);

        try {
            // Save the model
            if ($group->save()) {
                return redirect()->route('admin.groups.index')->with('flash.banner', 'Group created successfully!');
            } else {
                return redirect()->back()->withInput()->with('flash.banner', 'Failed to create Group.')->with('flash.bannerStyle', 'danger');
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

        $group = Group::findOrFail($id); // You can adjust the number of records per page (e.g., 10)

        // Pass the paginated data to the Inertia view
        return Inertia::render('Admin/Groups/Edit', [
            'group' => $group,
        ]);
    }

    public function update(Request $request, $id)
    {
        // dd($request);
        // Find the group by ID
        $group = Group::findOrFail($id);

        // Define validation rules
        $validationRules = [
            'name' => 'required|unique:groups,name,' . $id,
        ];

        // Custom error messages for validation
        $customMessages = [
            'name.required' => 'Please provide a name.',
            'name.unique' => 'This Group already exists.',
        ];

        // Validate the incoming request data
        $validatedData = $request->validate($validationRules, $customMessages);

        $oldAttachment = $group->attachment;
        // Update the group with the validated data
        $group->update($validatedData);
        $group->updated_by = auth()->id();

        // Convert the name to a slug
        $group->slug = Str::slug($validatedData['name']);

        try {

            // Save the model
            if ($group->save()) {
                return redirect()->route('admin.groups.index')->with('flash.banner', 'Group updated successfully!');
            } else {
                return redirect()->back()->withInput()->with('flash.banner', 'Failed to update Group.');
            }
        } catch (\Exception $e) {
            // Handle the error
            return redirect()->back()->withInput()->with('flash.banner', $e->getMessage());
        }
    }


    public function destroy($id)
    {
        // Find the group by ID
        $group = Group::findOrFail($id);

        // Delete the attachment file if it exists

        // Delete the group
        $group->delete();

        // Redirect to the group index page with a success message
        return redirect()->route('admin.groups.index')->with('flash.banner', 'Group deleted successfully!');
    }

    public function status(Request $request, Group $group)
    {
        if ($request->input('status') === 1) {
            $group->status = 0;
            $message = 'Group is hidden now!';
        } else {
            $group->status = 1;
            $message = 'Group is visible to all!';
        }
        $group->updated_by = auth()->id();

        if ($group->save()) {
            return redirect()->route('admin.groups.index')->with('flash.banner', $message);
        } else {
            return redirect()->back()->with('flash.banner', 'Failed to update Visibility.');
        }
    }
}
