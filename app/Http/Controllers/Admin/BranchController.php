<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Branch;
use Inertia\Inertia;
use Illuminate\Support\Str;

class BranchController extends Controller
{
    public function index()
    {
        // Retrieve paginated records from the branches table
        $branches = Branch::orderby('name')
        ->with(['createdBy', 'updatedBy'])
        ->paginate(10);

        // Pass the paginated data to the Inertia view
        return Inertia::render('Admin/Branches/Index', [
            'branches' => $branches,
        ]);
    }


    public function create()
    {
        // Show the form for create
        return Inertia::render('Admin/Branches/Create');
    }

    public function store(Request $request)
    {
        // dd($request);
        // Define validation rules
        $validationRules = [
            'name' => 'required|unique:branches',
            'address' => 'nullable',
            'in_charge' => 'nullable',
        ];

        // Custom error messages for validation
        $customMessages = [
            'name.required' => 'Please provide a name.',
            'name.unique' => 'This Branch already exists.',
        ];


        // Validate the incoming request data
        $validatedData = $request->validate($validationRules, $customMessages);

        // Create a new model and populate it with validated data
        $branch = new Branch;
        $branch->fill($validatedData);

        $branch->created_by = auth()->id();

        // Convert the name to a slug
        $branch->slug = Str::slug($validatedData['name']);

        try {
            // Save the model
            if ($branch->save()) {
                return redirect()->route('admin.branches.index')->with('flash.banner', 'Branch created successfully!');
            } else {
                return redirect()->back()->withInput()->with('flash.banner', 'Failed to create Branch.')->with('flash.bannerStyle', 'danger');
            }
        } catch (\Exception $e) {
            // Handle the error
            return redirect()->back()->withInput()->with('flash.banner', $e->getMessage())->with('flash.bannerStyle', 'danger');
        }
    }

    public function show(Branch $branch)
    {
        // Display a specific one
    }

    public function edit(Branch $branch)
    {
        // Show the form for editing

        // Pass the paginated data to the Inertia view
        return Inertia::render('Admin/Branches/Show', [
            'branch' => $branch,
        ]);
    }

    public function update(Request $request, Branch $branch)
    {
        // dd($request);

        // Define validation rules
        $validationRules = [
            'name' => 'required|unique:branches,name,' . $branch->id,
            'address' => 'nullable',
            'in_charge' => 'nullable',
        ];

        // Custom error messages for validation
        $customMessages = [
            'name.required' => 'Please provide a name.',
            'name.unique' => 'This Branch already exists.',
        ];

        // Validate the incoming request data
        $validatedData = $request->validate($validationRules, $customMessages);

        // Update the branch with the validated data
        $branch->update($validatedData);
        $branch->updated_by = auth()->id();

        // Convert the name to a slug
        $branch->slug = Str::slug($validatedData['name']);

        try {

            // Save the model
            if ($branch->save()) {
                return redirect()->route('admin.branches.index')->with('flash.banner', 'Branch updated successfully!');
            } else {
                return redirect()->back()->withInput()->with('flash.banner', 'Failed to update Branch.');
            }
        } catch (\Exception $e) {
            // Handle the error
            return redirect()->back()->withInput()->with('flash.banner', $e->getMessage());
        }
    }


    public function destroy(Branch $branch)
    {
        // Delete the attachment file if it exists

        // Delete the branch
        $branch->delete();

        // Redirect to the branch index page with a success message
        return redirect()->route('admin.branches.index')->with('flash.banner', 'Branch deleted successfully!');
    }

    public function status(Request $request, Branch $branch)
    {
        if ($request->input('status') === 1) {
            $branch->status = 0;
            $message = 'Branch is hidden now!';
        } else {
            $branch->status = 1;
            $message = 'Branch is visible to all!';
        }
        $branch->updated_by = auth()->id();

        if ($branch->save()) {
            return redirect()->route('admin.branches.index')->with('flash.banner', $message);
        } else {
            return redirect()->back()->with('flash.banner', 'Failed to update Visibility.');
        }
    }
}
