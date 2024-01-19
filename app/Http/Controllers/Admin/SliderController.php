<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Slider;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
class SliderController extends Controller
{
    public function index()
    {
        // Retrieve paginated records from the sliders table
        $sliders = Slider::orderby('created_at', 'desc')
        ->with(['createdBy', 'updatedBy'])
        ->paginate(10);

        // Pass the paginated data to the Inertia view
        return Inertia::render('Admin/Sliders/Index', [
            'sliders' => $sliders,
        ]);
    }


    public function create()
    {
        // Show the form for create
        return Inertia::render('Admin/Sliders/Create');
    }

    public function store(Request $request)
    {
        // dd($request);
        // Define validation rules
        $validationRules = [
            'caption' => 'required',
            'path' => 'required|mimes:pdf,doc,docx,jpg,jpeg,png|max:1024', // 1MB (1024 KB) limit
        ];

        // Custom error messages for validation
        $customMessages = [
            'caption.required' => 'Please provide a caption.',
            'path.required' => 'Please provide an image.',
            'path.mimes' => 'Invalid file format. Only pdf, doc, docx, jpg, jpeg, png files are allowed.',
            'path.max' => 'The path must not be larger than 1MB.',
        ];


        // Validate the incoming request data
        $validatedData = $request->validate($validationRules, $customMessages);

        // Create a new model and populate it with validated data
        $slider = new Slider;
        $slider->fill($validatedData);

        $slider->created_by = auth()->id();

        // Convert the caption to a slug
        $slider->slug = Str::slug($validatedData['caption']);

        // Check if the slug already exists in the database
        if (Slider::where('slug', $slider->slug)->exists()) {
            // If the slug already exists for a different item,
            // modify the slug to make it unique by appending a count
            $count = 1;
            $originalSlug = $slider->slug;
            while (Slider::where('slug', $slider->slug)->exists()) {
                $slider->slug = $originalSlug . '-' . $count;
                $count++;
            }
        }

        try {
            if ($request->hasFile('path')) {
                // dd('gotcha');
                // Get the uploaded file from the request
                $path = $request->file('path');

                // Validate the file size and type
                if ($path->isValid()) {
                    // Generate a unique name for the file based on the slug and the file extension
                    $fileName = $slider->slug . '.' . $path->getClientOriginalExtension();

                    // Store the file in the storage directory with the generated name
                    $pathPath = $path->storeAs('sliders', $fileName, 'public');

                    // Save the file path in the database
                    $slider->path = $pathPath;
                } else {
                    return redirect()->back()->withInput()->with('flash.banner', 'Failed to upload Slider.');
                }
            }


            // Save the model
            if ($slider->save()) {
                return redirect()->route('admin.sliders.index')->with('flash.banner', 'Slider created successfully!');
            } else {
                return redirect()->back()->withInput()->with('flash.banner', 'Failed to create Slider.');
            }
        } catch (\Exception $e) {
            // Handle the error
            return redirect()->back()->withInput()->with('flash.banner', $e->getMessage());
        }
    }

    public function show($id)
    {
        // Display a specific one
    }

    public function edit($id)
    {
        // Show the form for editing

        $slider = Slider::findOrFail($id); // You can adjust the number of records per page (e.g., 10)

        // Pass the paginated data to the Inertia view
        return Inertia::render('Admin/Sliders/Edit', [
            'slider' => $slider,
        ]);
    }

    public function update(Request $request, $id)
    {

        // Find the slider by ID
        $slider = Slider::findOrFail($id);
    
        // Define validation rules
        $validationRules = [
            'caption' => 'required',
            'path' => 'nullable|mimes:pdf,doc,docx,jpg,jpeg,png|max:1024', // 1MB (1024 KB) limit
        ];
    
        // Custom error messages for validation
        $customMessages = [
            'caption.required' => 'Please provide a caption.',
            'path.mimes' => 'Invalid file format. Only pdf, doc, docx, jpg, jpeg, png files are allowed.',
            'path.max' => 'The path must not be larger than 1MB.',
        ];
    
        // Validate the incoming request data
        $validatedData = $request->validate($validationRules, $customMessages);
        
        $oldPath = $slider->path;
        
        // dd($request);
        // Update the slider with the validated data
        $slider->update($validatedData);
        $slider->path = $oldPath;
        $slider->updated_by = auth()->id();

        // Convert the caption to a slug
        $slider->slug = Str::slug($validatedData['caption']);

        // Check if the slug already exists in the database
        if (Slider::where('slug', $slider->slug)->exists()) {
            // If the slug already exists for a different item,
            // modify the slug to make it unique by appending a count
            $count = 1;
            $originalSlug = $slider->slug;
            while (Slider::where('slug', $slider->slug)->exists()) {
                $slider->slug = $originalSlug . '-' . $count;
                $count++;
            }
        }

        try {
            if ($request->hasFile('path') ) {
                // dd('gotcha');
                // Get the uploaded file from the request
                $path = $request->file('path');

                // Validate the file size and type
                if ($path->isValid()) {
                    // Generate a unique name for the file based on the slug and the file extension
                    $fileName = $slider->slug . '.' . $path->getClientOriginalExtension();

                    // Store the file in the storage directory with the generated name
                    $pathPath = $path->storeAs('sliders', $fileName, 'public');

                    // Save the file path in the database
                    $slider->path = $pathPath;
                } else {
                    return redirect()->back()->withInput()->with('flash.banner', 'Failed to upload Slider.');
                }
            }


            // Save the model
            if ($slider->save()) {
                return redirect()->route('admin.sliders.index')->with('flash.banner', 'Slider updated successfully!');
            } else {
                return redirect()->back()->withInput()->with('flash.banner', 'Failed to update Slider.');
            }
        } catch (\Exception $e) {
            // Handle the error
            return redirect()->back()->withInput()->with('flash.banner', $e->getMessage());
        }
        
    }
    

    public function destroy($id)
    {
        // Find the slider by ID
        $slider = Slider::findOrFail($id);

        // Delete the path file if it exists
        if ($slider->path) {
            Storage::disk('public')->delete($slider->path);
        }

        // Delete the slider
        $slider->delete();

        // Redirect to the slider index page with a success message
        return redirect()->route('admin.sliders.index')->with('flash.banner', 'Slider deleted successfully!');
    }

    public function status(Request $request, Slider $slider)
    {
        if ($request->input('status') === 1) {
            $slider->status = 0;
            $message = 'Slider is hidden now!';
        } else {
            $slider->status = 1;
            $message = 'Slider is visible to all!';
        }
        $slider->updated_by = auth()->id();

        if ($slider->save()) {
            return redirect()->route('admin.sliders.index')->with('flash.banner', $message);
        } else {
            return redirect()->back()->with('flash.banner', 'Failed to update Visibility.');
        }
    }
}
