<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Branch;
use App\Models\Admin\Building;
use Inertia\Inertia;
use Illuminate\Support\Str;

class BuildingController extends Controller
{
    public function index()
    {
        // Retrieve paginated records from the buildings table
        $buildings = Building::with('rooms')->orderby('name')
            ->with(['createdBy', 'updatedBy'])
            ->paginate(10);

        // Pass the paginated data to the Inertia view
        return Inertia::render('Admin/Buildings/Index', [
            'buildings' => $buildings,
        ]);
    }


    public function create()
    {
        $branches = Branch::orderBy('name')->get();
        $singleBranch = $branches->count() === 1 ? $branches->first() : null;
    
        // Show the form for create
        return Inertia::render('Admin/Buildings/Create', [
            'branches' => $branches,
            'singleBranch' => $singleBranch,
        ]);
    }
    
    

    public function store(Request $request)
    {
        // dd($request);
        // Define validation rules
        $validationRules = [
            'branch_id' => 'required',
            'name' => 'required|unique:buildings',
        ];

        // Custom error messages for validation
        $customMessages = [
            'branch_id.required' => 'Please select a Branch.',
            'name.required' => 'Please provide a name.',
            'name.unique' => 'This Building already exists.',
        ];


        // Validate the incoming request data
        $validatedData = $request->validate($validationRules, $customMessages);

        // Create a new model and populate it with validated data
        $building = new Building;
        $building->fill($validatedData);

        $building->created_by = auth()->id();

        // Convert the name to a slug
        $building->slug = Str::slug($validatedData['name']);

        try {
            // Save the model
            if ($building->save()) {
                return redirect()->route('admin.buildings.index')->with('flash.banner', 'Building created successfully!');
            } else {
                return redirect()->back()->withInput()->with('flash.banner', 'Failed to create Building.')->with('flash.bannerStyle', 'danger');
            }
        } catch (\Exception $e) {
            // Handle the error
            return redirect()->back()->withInput()->with('flash.banner', $e->getMessage())->with('flash.bannerStyle', 'danger');
        }
    }

    public function show(Building $building)
    {
        // Display a specific one
    }

    public function edit(Building $building)
    {
        $branches = Branch::orderBy('name')->get();
       
        // Show the form for editing
        return Inertia::render('Admin/Buildings/Edit', [
            'branches' => $branches,
            'selectedBranch' => $building->branch,
            'building' => $building,
        ]);
    }

    public function update(Request $request, Building $building)
    {
        // dd($request);

        // Define validation rules
        $validationRules = [
            'branch_id' => 'required',
            'name' => 'required|unique:buildings,name,' . $building->id,
        ];

        // Custom error messages for validation
        $customMessages = [
            'branch_id.required' => 'Please select a Branch.',
            'name.required' => 'Please provide a name.',
            'name.unique' => 'This Building already exists.',
        ];

        // Validate the incoming request data
        $validatedData = $request->validate($validationRules, $customMessages);

        // Update the building with the validated data
        $building->update($validatedData);
        $building->updated_by = auth()->id();

        // Convert the name to a slug
        $building->slug = Str::slug($validatedData['name']);

        try {

            // Save the model
            if ($building->save()) {
                return redirect()->route('admin.buildings.index')->with('flash.banner', 'Building updated successfully!');
            } else {
                return redirect()->back()->withInput()->with('flash.banner', 'Failed to update Building.');
            }
        } catch (\Exception $e) {
            // Handle the error
            return redirect()->back()->withInput()->with('flash.banner', $e->getMessage());
        }
    }


    public function destroy(Building $building)
    {
        // Delete the attachment file if it exists

        // Delete the building
        $building->delete();

        // Redirect to the building index page with a success message
        return redirect()->route('admin.buildings.index')->with('flash.banner', 'Building deleted successfully!');
    }

    public function status(Request $request, Building $building)
    {
        if ($request->input('status') === 1) {
            $building->status = 0;
            $message = 'Building is hidden now!';
        } else {
            $building->status = 1;
            $message = 'Building is visible to all!';
        }
        $building->updated_by = auth()->id();

        if ($building->save()) {
            return redirect()->route('admin.buildings.index')->with('flash.banner', $message);
        } else {
            return redirect()->back()->with('flash.banner', 'Failed to update Visibility.');
        }
    }
}
