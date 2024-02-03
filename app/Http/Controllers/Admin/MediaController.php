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
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;

class MediaController extends Controller
{
    public function index(Album $album)
    {
        // Get a query builder instance for the media associated with the album
        $mediaFiles = Media::where('album_id', $album->id)->paginate(20);

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
        // Define validation rules
        $validationRules = [
            'caption' => 'required',
            'paths.*' => 'required|mimes:pdf,doc,docx,jpg,jpeg,png'
            // 'path' => 'required|mimes:pdf,doc,docx,jpg,jpeg,png|max:1024', // 1MB (1024 KB) limit
        ];

        // Custom error messages for validation
        $customMessages = [
            'caption.required' => 'Please provide a caption.',
            'paths.*.required' => 'Please provide an image.',
            'paths.*.mimes' => 'Invalid file format. Only pdf, doc, docx, jpg, jpeg, png files are allowed.',
            // 'path.max' => 'The path must not be larger than 1MB.',
        ];

        // Validate the incoming request data
        $validatedData = $request->validate($validationRules, $customMessages);

        $caption = $request->input('caption');

        foreach ($request->file('paths') as $path) {
            $media = new Media([
                'caption' => $caption,
                'album_id' => $album->id,
                'created_by' => auth()->id(),
            ]);

            try {
                // Validate the file size and type
                if ($path->isValid()) {
                    // Generate a unique name for the file based on the slug and the file extension
                    $slug = Str::slug($validatedData['caption']);
                    $ext = '.jpeg';
                    $fileName = $slug . $ext;

                    $manager = new ImageManager(new Driver());
                    $image = $manager->read($path);

                    // Resize the image (adjust dimensions as needed)
                    $image->scale(1920, 1080);
                    // Initialize the quality variable
                    $quality = 80; // Initial quality value

                    // Loop until the image size is below 300KB
                    while (true) {
                        // Encode the image with the current quality
                        $encodedImage = $image->toJpeg($quality);

                        // Get the image size in bytes
                        $imageSize = strlen($encodedImage->__toString());

                        // Break the loop if the image size is below 300KB
                        if ($imageSize < 300 * 1024) {
                            break;
                        }

                        // Reduce the quality for the next iteration
                        $quality -= 5; // Adjust the decrement value based on your preference

                        // Ensure the quality does not go below 10 (or adjust as needed)
                        $quality = max($quality, 20);
                    }


                    $filePath = 'media/' . $fileName;

                    // Check if the slug already exists in the database
                    if (Media::where('path', $filePath)->exists()) {
                        // If the slug already exists for a different item,
                        // modify the slug to make it unique by appending a count
                        $count = 1;
                        while (Media::where('path', $filePath)->exists()) {
                            $fileName = $slug . '-' . $count . $ext;
                            $filePath = 'media/' . $fileName;
                            $count++;
                        }
                    }

                    // Store the file in the storage directory with the generated name
                    $encodedImage->save('storage/media/' . $fileName);
                    // Save the file path in the database
                    $media->path = $filePath;
                } else {
                    return redirect()->back()->withInput()->with('flash.banner', 'Failed to upload Media.');
                }

                // Save the model
                if (!$media->save()) {
                    return redirect()->back()->withInput()->with('flash.banner', 'Failed to create Media.');
                }
            } catch (\Exception $e) {
                // Handle the error
                return redirect()->back()->withInput()->with('flash.banner', $e->getMessage());
            }
        }
        return redirect()->route('admin.albums.media.index', $album->id)->with('flash.banner', 'Media created successfully!');
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
        return Inertia::render('Admin/Media/Edit', [
            'media' => $medium,
            'album' => $album,
            'albums' => $albums,
        ]);
    }

    public function update(Request $request, Album $album, Media $medium)
    {
        // Define validation rules
        $validationRules = [
            'album_id' => 'required',
            'caption' => 'required',
            'path' => 'nullable|mimes:pdf,doc,docx,jpg,jpeg,png',
            // 'path' => 'nullable|mimes:pdf,doc,docx,jpg,jpeg,png|max:1024', // 1MB (1024 KB) limit
        ];

        // Custom error messages for validation
        $customMessages = [
            'album_id.required' => 'Please select an album.',
            'caption.required' => 'Please provide a caption.',
            'path.mimes' => 'Invalid file format. Only pdf, doc, docx, jpg, jpeg, png files are allowed.',
            // 'path.max' => 'The path must not be larger than 1MB.',
        ];

        // Validate the incoming request data
        $validatedData = $request->validate($validationRules, $customMessages);

        $oldCaption = $medium->caption;
        $oldPath = $medium->path;

        // Update the media with the validated data
        $medium->update($validatedData);

        $medium->updated_by = auth()->id();

        try {
            if ($request->hasFile('path')) {

                if ($oldPath) {
                    Storage::disk('public')->delete($oldPath);
                }
                // Get the uploaded file from the request
                $path = $request->file('path');

                // Validate the file size and type
                if ($path->isValid()) {
                    // Generate a unique name for the file
                    $slug = Str::slug($validatedData['caption']);
                    $ext = '.jpeg';
                    $fileName = $slug . $ext;

                    $manager = new ImageManager(new Driver());
                    $image = $manager->read($path);

                    // Resize the image (adjust dimensions as needed)
                    $image->scale(1920, 1080);
                    // Initialize the quality variable
                    $quality = 80; // Initial quality value

                    // Loop until the image size is below 300KB
                    while (true) {
                        // Encode the image with the current quality
                        $encodedImage = $image->toJpeg($quality);

                        // Get the image size in bytes
                        $imageSize = strlen($encodedImage->__toString());

                        // Break the loop if the image size is below 300KB
                        if ($imageSize < 300 * 1024) {
                            break;
                        }

                        // Reduce the quality for the next iteration
                        $quality -= 5; // Adjust the decrement value based on your preference

                        // Ensure the quality does not go below 10 (or adjust as needed)
                        $quality = max($quality, 20);
                    }


                    $filePath = 'media/' . $fileName;

                    // Check if the slug already exists in the database
                    if (Media::where('path', $filePath)->exists() && $filePath != $oldPath) {
                        // If the slug already exists for a different item,
                        // modify the slug to make it unique by appending a count
                        $count = 1;
                        while (Media::where('path', $filePath)->exists() && $filePath != $oldPath) {
                            $fileName = $slug . '-' . $count . $ext;
                            $filePath = 'media/' . $fileName;
                            $count++;
                        }
                    }

                    // Store the file in the storage directory with the generated name
                    $encodedImage->save('storage/media/' . $fileName);
                    // Save the file path in the database
                    $medium->path = $filePath;
                } else {
                    return redirect()->back()->withInput()->with('flash.banner', 'Failed to upload Media.');
                }
            } elseif ($oldCaption != $medium->caption) {
                // Generate a unique name for the file
                $slug = Str::slug($validatedData['caption']);
                $ext = '.jpeg';
                // New file name
                $newFileName = $slug . $ext;

                // New file path
                $newPath = 'media/' . $newFileName;
                // Check if the slug already exists in the database
                if (Media::where('path', $newPath)->exists() && $newPath != $oldPath) {
                    // If the slug already exists for a different item,
                    // modify the slug to make it unique by appending a count
                    $count = 1;
                    while (Media::where('path', $newPath)->exists() && $newPath != $oldPath) {
                        $newFileName = $slug . '-' . $count . $ext;
                        $newPath = 'media/' . $newFileName;
                        $count++;
                    }
                }

                $medium->path = $newPath;
                // Old file path with 'storage/' prefix
                $oldPathWithPrefix = 'public/' . $oldPath;

                // New file path with 'storage/' prefix
                $newPathWithPrefix = 'public/' . $newPath;

                // Rename the file
                Storage::move($oldPathWithPrefix, $newPathWithPrefix);
            } else {
                $medium->path = $oldPath;
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
