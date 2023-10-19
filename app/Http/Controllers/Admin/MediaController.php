<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Media;
use App\Models\Admin\Album;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    public function index(Album $album)
    {
        // Get a query builder instance for the media associated with the album
        $mediaFiles = Media::where('album_id', $album->id)->paginate(10);

        return Inertia::render('Admin/Media/Index', [
            'album' => $album,
            'mediaFiles' => $mediaFiles,
        ]);
    }



    public function create(Album $album)
    {
        // Show the form for create
        return Inertia::render('Admin/Media/Create', [
            'album' => $album,
        ]);
    }

    public function store(Request $request, Album $album)
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
        $media = new Media;
        $media->fill($validatedData);

        $media->album_id = $album->id;
        $media->created_by = auth()->id();

        // dd($media);

        try {
            if ($request->hasFile('path')) {
                // dd('gotcha');
                // Get the uploaded file from the request
                $path = $request->file('path');

                // Validate the file size and type
                if ($path->isValid()) {
                    $slug = Str::slug($validatedData['caption']);
                    // Generate a unique name for the file based on the slug and the file extension
                    $fileName = $slug . '.' . $path->getClientOriginalExtension();

                    // Store the file in the storage directory with the generated name
                    $filePath = $path->storeAs('media', $fileName, 'public');
                    // Check if the slug already exists in the database
                    if (Media::where('path', $filePath)->exists()) {
                        // If the slug already exists for a different item,
                        // modify the slug to make it unique by appending a count
                        $count = 1;
                        while (Media::where('path', $filePath)->exists()) {
                            $fileName = $slug . '-' . $count . '.' . $path->getClientOriginalExtension();
                            // Store the file in the storage directory with the generated name
                            $filePath = $path->storeAs('media', $fileName, 'public');
                            $count++;
                        }
                    }
                    // Save the file path in the database
                    $media->path = $filePath;
                } else {
                    return redirect()->back()->withInput()->with('flash.banner', 'Failed to upload Media.');
                }
            }


            // Save the model
            if ($media->save()) {
                return redirect()->route('admin.albums.media.index', $album->id)->with('flash.banner', 'Media created successfully!');
            } else {
                return redirect()->back()->withInput()->with('flash.banner', 'Failed to create Media.');
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

    public function edit(Album $album, Media $medium)
    {
        // $media = Media::findOrFail($media);
        // dd($medium);
        $albums = Album::all();
        // Pass the paginated data to the Inertia view
        return Inertia::render('Admin/Media/Show', [
            'media' => $medium,
            'album' => $album,
            'albums' => $albums,
        ]);
    }

    public function update(Request $request, Album $album, Media $medium)
    {
        // dd($request);

        // Find the media by ID
        // $media = Media::findOrFail($id);

        // Define validation rules
        $validationRules = [
            'album_id' => 'required',
            'caption' => 'required',
            'path' => 'nullable|mimes:pdf,doc,docx,jpg,jpeg,png|max:1024', // 1MB (1024 KB) limit
        ];

        // Custom error messages for validation
        $customMessages = [
            'album_id.required' => 'Please select an album.',
            'caption.required' => 'Please provide a caption.',
            'path.mimes' => 'Invalid file format. Only pdf, doc, docx, jpg, jpeg, png files are allowed.',
            'path.max' => 'The path must not be larger than 1MB.',
        ];

        // Validate the incoming request data
        $validatedData = $request->validate($validationRules, $customMessages);

        $oldPath = $medium->path;

        // dd($validatedData);
        // Update the media with the validated data
        $medium->update($validatedData);
        $medium->path = $oldPath;
        $medium->updated_by = auth()->id();
        // dd($medium);

        try {
            if ($request->hasFile('path')) {
                // dd('gotcha');
                // Get the uploaded file from the request
                $path = $request->file('path');

                // Validate the file size and type
                if ($path->isValid()) {
                    $slug = Str::slug($validatedData['caption']);
                    // Generate a unique name for the file based on the slug and the file extension
                    $fileName = $slug . '.' . $path->getClientOriginalExtension();

                    // Store the file in the storage directory with the generated name
                    $filePath = $path->storeAs('media', $fileName, 'public');
                    // Check if the slug already exists in the database
                    if (Media::where('path', $filePath)->exists()) {
                        // If the slug already exists for a different item,
                        // modify the slug to make it unique by appending a count
                        $count = 1;
                        while (Media::where('path', $filePath)->exists()) {
                            $fileName = $slug . '-' . $count . '.' . $path->getClientOriginalExtension();
                            // Store the file in the storage directory with the generated name
                            $filePath = $path->storeAs('media', $fileName, 'public');
                            $count++;
                        }
                    }
                    // Save the file path in the database
                    $medium->path = $filePath;
                } else {
                    return redirect()->back()->withInput()->with('flash.banner', 'Failed to upload Media.');
                }
            }


            // Save the model
            if ($medium->save()) {
                return redirect()->route('admin.albums.media.index', $album->id)->with('flash.banner', 'Media updated successfully!');
            } else {
                return redirect()->back()->withInput()->with('flash.banner', 'Failed to update Media.');
            }
        } catch (\Exception $e) {
            // Handle the error
            return redirect()->back()->withInput()->with('flash.banner', $e->getMessage());
        }
    }


    public function destroy(Album $album, Media $medium)
    {

        // Delete the path file if it exists
        if ($medium->path) {
            Storage::disk('public')->delete($medium->path);
        }

        // Delete the media
        $medium->delete();

        // Redirect to the media index page with a success message
        return redirect()->route('admin.albums.media.index', $album->id)->with('flash.banner', 'Media deleted successfully!');
    }
}
