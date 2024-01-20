<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Slider;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;
class SliderController extends Controller
{
    public function index()
    {
        // Retrieve paginated records from the sliders table
        $sliders = Slider::orderby('priority')
            ->with(['createdBy', 'updatedBy'])
            ->paginate(10);

        // Pass the paginated data to the Inertia view
        return Inertia::render('Admin/Sliders/Index', [
            'sliders' => $sliders,
        ]);
    }


    public function create()
    {
        // Retrieve all sliders to get the current priorities
        $sliders = Slider::orderBy('priority')->get();

        // Extract current priorities into an array
        $currentPriorities = $sliders->pluck('priority')->toArray();

        // Add one more priority to the end
        $currentPriorities[] = count($currentPriorities) + 1;

        // Transform current priorities into an array of objects with 'id' and 'name'
        $priorities = array_map(function ($priority) {
            return ['id' => $priority, 'name' => $this->ordinal($priority)];
        }, $currentPriorities);

        // Show the form for create with the current priorities
        return Inertia::render('Admin/Sliders/Create', [
            'priorities' => $priorities,
        ]);
    }

    // Function to convert numbers to ordinal representation (1st, 2nd, 3rd, etc.)


    public function store(Request $request)
    {
        // dd($request);
        // Define validation rules
        $validationRules = [
            'caption' => 'required',
            // 'path' => 'required|mimes:pdf,doc,docx,jpg,jpeg,png|max:1024', // 1MB (1024 KB) limit
            'path' => 'required|mimes:jpg,jpeg,png', // 1MB (1024 KB) limit
        ];

        // Custom error messages for validation
        $customMessages = [
            'caption.required' => 'Please provide a caption.',
            'path.required' => 'Please provide an image.',
            'path.mimes' => 'Invalid file format. Only jpg, jpeg, png files are allowed.',
            // 'path.max' => 'The path must not be larger than 1MB.',
        ];


        // Validate the incoming request data
        $validatedData = $request->validate($validationRules, $customMessages);

        // Create a new model and populate it with validated data
        $slider = new Slider;
        $slider->fill($validatedData);

        $slider->created_by = auth()->id();

        // Set the priority based on the user's selection or default to the last priority
        $selectedPriority = $request->input('priority');

        // Retrieve all sliders to get the current priorities
        $sliders = Slider::orderBy('priority')->get();

        // Extract current priorities into an array
        $currentPriorities = $sliders->pluck('priority')->toArray();

        $conflictingIndex = array_search($selectedPriority, $currentPriorities);

        // If conflicting index is found, adjust priorities
        if ($conflictingIndex !== false) {
            // Increment the priorities of items after the conflicting one
            for ($i = $conflictingIndex; $i < count($currentPriorities); $i++) {
                $currentPriorities[$i]++;
            }
            // dd($currentPriorities);
            // Update priorities for all sliders
            foreach ($sliders as $index => $sliderItem) {
                $sliderItem->priority = $currentPriorities[$index];
                $sliderItem->save();
            }
        }

        // Set the priority for the current slider
        $slider->priority = $selectedPriority;
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

                    $manager = new ImageManager(new Driver());
                    $image = $manager->read($path);

                    $image->cover(1920, 1080);

                    // Generate a unique name for the file based on the slug and the file extension
                    $fileName = $slider->slug . '.jpeg';

                    // Store the file in the storage directory with the generated name
                    $image->toJpeg()->save(public_path('storage/sliders/' . $fileName));

                    // Save the file photo in the database
                    $slider->path = 'sliders/' . $fileName;

                    // // Generate a unique name for the file based on the slug and the file extension
                    // $fileName = $slider->slug . '.' . $path->getClientOriginalExtension();

                    // // Store the file in the storage directory with the generated name
                    // $pathPath = $path->storeAs('sliders', $fileName, 'public');

                    // // Save the file path in the database
                    // $slider->path = $pathPath;
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
        // Retrieve all sliders to get the current priorities
        $sliders = Slider::orderBy('priority')->get();

        // Extract current priorities into an array
        $currentPriorities = $sliders->pluck('priority')->toArray();

        // Transform current priorities into an array of objects with 'id' and 'name'
        $priorities = array_map(function ($priority) {
            return ['id' => $priority, 'name' => $this->ordinal($priority)];
        }, $currentPriorities);
        // Pass the paginated data to the Inertia view
        return Inertia::render('Admin/Sliders/Edit', [
            'slider' => $slider,
            'priorities' => $priorities,
        ]);
    }

    public function update(Request $request, $id)
    {

        // Find the slider by ID
        $slider = Slider::findOrFail($id);

        // Define validation rules
        $validationRules = [
            'caption' => 'required',
            // 'path' => 'nullable|mimes:pdf,doc,docx,jpg,jpeg,png|max:1024', // 1MB (1024 KB) limit
            'path' => 'nullable|mimes:jpg,jpeg,png', // 1MB (1024 KB) limit
        ];

        // Custom error messages for validation
        $customMessages = [
            'caption.required' => 'Please provide a caption.',
            'path.mimes' => 'Invalid file format. Only jpg, jpeg, png files are allowed.',
            // 'path.max' => 'The path must not be larger than 1MB.',
        ];

        // Validate the incoming request data
        $validatedData = $request->validate($validationRules, $customMessages);

        $oldPath = $slider->path;

        // dd($request);
        // Update the slider with the validated data
        $slider->update($validatedData);
        $slider->path = $oldPath;
        $slider->updated_by = auth()->id();


        // Set the priority based on the user's selection or default to the last priority
        $selectedPriority = $request->input('priority');

        // Retrieve all sliders to get the current priorities
        $sliders = Slider::orderBy('priority')->get();

        // Extract current priorities into an array
        $currentPriorities = $sliders->pluck('priority')->toArray();

        $conflictingIndex = array_search($selectedPriority, $currentPriorities);

        // If conflicting index is found, adjust priorities
        if ($conflictingIndex !== false && $selectedPriority !== $slider->priority) {
            // dd('chk3');
            // Increment the priorities of items after the conflicting one

            if ($slider->priority > $selectedPriority) {
                // dd('+');
                for ($i = $conflictingIndex; $i < $slider->priority; $i++) {
                    $currentPriorities[$i]++;
                }
            } else {
                // dd('-');
                for ($i = $conflictingIndex; $i > $slider->priority - 1; $i--) {
                    $currentPriorities[$i]--;
                }
            }


            // dd($currentPriorities);
            // Update priorities for all sliders
            foreach ($sliders as $index => $sliderItem) {
                $sliderItem->priority = $currentPriorities[$index];
                $sliderItem->save();
            }
        }

        // Set the priority for the current slider
        $slider->priority = $selectedPriority;

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

                    $manager = new ImageManager(new Driver());
                    $image = $manager->read($path);

                    $image->cover(1920, 1080);

                    // Generate a unique name for the file based on the slug and the file extension
                    $fileName = $slider->slug . '.jpeg';

                    // Store the file in the storage directory with the generated name
                    $image->toJpeg()->save(public_path('storage/sliders/' . $fileName));

                    // Save the file photo in the database
                    $slider->path = 'sliders/' . $fileName;

                    // // Generate a unique name for the file based on the slug and the file extension
                    // $fileName = $slider->slug . '.' . $path->getClientOriginalExtension();

                    // // Store the file in the storage directory with the generated name
                    // $pathPath = $path->storeAs('sliders', $fileName, 'public');

                    // // Save the file path in the database
                    // $slider->path = $pathPath;
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


        // Set the priority based on the user's selection or default to the last priority
        $selectedPriority = $slider->priority;

        // Retrieve all sliders to get the current priorities
        $sliders = Slider::orderBy('priority')->get();

        // Extract current priorities into an array
        $currentPriorities = $sliders->pluck('priority')->toArray();

        $conflictingIndex = array_search($selectedPriority, $currentPriorities);

        // If conflicting index is found, adjust priorities
        if ($conflictingIndex !== false) {


            // Increment the priorities of items after the conflicting one
            for ($i = $conflictingIndex; $i < count($currentPriorities); $i++) {
                $currentPriorities[$i]--;
            }
            // Update priorities for all sliders
            foreach ($sliders as $index => $sliderItem) {
                $sliderItem->priority = $currentPriorities[$index];
                $sliderItem->save();
            }
        }


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

    private function ordinal($number)
    {
        $suffix = ['th', 'st', 'nd', 'rd', 'th', 'th', 'th', 'th', 'th', 'th'];
        if (($number % 100) >= 11 && ($number % 100) <= 13) {
            return $number . 'th';
        } else {
            return $number . $suffix[$number % 10];
        }
    }
}
