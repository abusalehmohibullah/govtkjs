<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Album;
use App\Models\Admin\Media;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class AlbumController extends Controller
{
    public function index()
    {
        // Retrieve albums with their first related media records
        $albums = Album::select('albums.*')
            ->addSelect(['path' => Media::select('path')
                ->whereColumn('album_id', 'albums.id')
                ->orderBy('created_at', 'asc')
                ->limit(1)
            ])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    
        // Pass the data to the Inertia view
        return Inertia::render('Admin/Albums/Index', [
            'albums' => $albums,
        ]);
    }
    
    
    
    



    public function create()
    {
        // Show the form for create
        return Inertia::render('Admin/Albums/Create');
    }

    public function store(Request $request)
    {
        // dd($request);
        // Define validation rules
        $validationRules = [
            'title' => 'required',
            'description' => 'nullable',
        ];

        // Custom error messages for validation
        $customMessages = [
            'title.required' => 'Please provide a title.',
            'path.required' => 'Please provide an image.',
        ];


        // Validate the incoming request data
        $validatedData = $request->validate($validationRules, $customMessages);

        // Create a new model and populate it with validated data
        $album = new Album;
        $album->fill($validatedData);

        $album->created_by = auth()->id();

        // Convert the title to a slug
        $album->slug = Str::slug($validatedData['title']);

        // Check if the slug already exists in the database
        if (Album::where('slug', $album->slug)->exists()) {
            // If the slug already exists for a different item,
            // modify the slug to make it unique by appending a count
            $count = 1;
            $originalSlug = $album->slug;
            while (Album::where('slug', $album->slug)->exists()) {
                $album->slug = $originalSlug . '-' . $count;
                $count++;
            }
        }

        try {
            // Save the model
            if ($album->save()) {
                return redirect()->route('admin.albums.index')->with('flash.banner', 'Album created successfully!');
            } else {
                return redirect()->back()->withInput()->with('flash.banner', 'Failed to create Album.');
            }
        } catch (\Exception $e) {
            // Handle the error
            return redirect()->back()->withInput()->with('flash.banner', $e->getMessage());
        }
    }

    public function show(Album $album)
    {
        // Display a specific one
    }

    public function edit(Album $album)
    {
        // Pass the paginated data to the Inertia view
        return Inertia::render('Admin/Albums/Show', [
            'album' => $album,
        ]);
    }

    public function update(Request $request, Album $album)
    {
        // Define validation rules
        $validationRules = [
            'title' => 'required',
            'description' => 'nullable',
        ];
    
        // Custom error messages for validation
        $customMessages = [
            'title.required' => 'Please provide a title.',
        ];
    
        // Validate the incoming request data
        $validatedData = $request->validate($validationRules, $customMessages);

        
        // dd($request);
        // Update the album with the validated data
        $album->update($validatedData);
        $album->updated_by = auth()->id();

        // Convert the title to a slug
        $album->slug = Str::slug($validatedData['title']);

        // Check if the slug already exists in the database
        if (Album::where('slug', $album->slug)->exists()) {
            // If the slug already exists for a different item,
            // modify the slug to make it unique by appending a count
            $count = 1;
            $originalSlug = $album->slug;
            while (Album::where('slug', $album->slug)->exists()) {
                $album->slug = $originalSlug . '-' . $count;
                $count++;
            }
        }

        try {
            // Save the model
            if ($album->save()) {
                return redirect()->route('admin.albums.index')->with('flash.banner', 'Album updated successfully!');
            } else {
                return redirect()->back()->withInput()->with('flash.banner', 'Failed to update Album.');
            }
        } catch (\Exception $e) {
            // Handle the error
            return redirect()->back()->withInput()->with('flash.banner', $e->getMessage());
        }
        
    }
    

    public function destroy(Album $album)
    {
        // Delete the album
        $album->delete();

        // Redirect to the album index page with a success message
        return redirect()->route('admin.albums.index')->with('flash.banner', 'Album deleted successfully!');
    }
}
