<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Admin\BasicInfo;

class BasicInfoController extends Controller
{
    public function show()
    {
        $basicInfo = BasicInfo::all(); // Retrieve all records from the basic_info table

        // Format basicInfo into an associative array
        $basicInfoArray = $basicInfo->pluck('content', 'key')->toArray();

        return Inertia::render('Admin/BasicInfo/Show', [
            'basicInfo' => $basicInfoArray,
        ]);
    }

    public function update(Request $request)
    {
        // dd($request);
        try {
            // Retrieve the keys as an array from the request
            $keysArray = $request->keys();

            // Retrieve all records from the basic_info table
            $basicInfo = BasicInfo::all();

            $updateSuccessful = false; // Flag to track whether any update was successful

            // Loop through the keys
            foreach ($keysArray as $key) {
                // Check if the key exists in the request data
                if ($request->has($key)) {
                    
                    if (str_ends_with($key, '_image') && $request->hasFile($key)) {
                        // dd('gotcha');
                        // Get the uploaded file from the request
                        $image = $request->file($key);

                        // Validate the file size and type
                        if ($image->isValid()) {
                            // Generate a unique name for the file based on the slug and the file extension
                            $fileName = $key . '.' . $image->getClientOriginalExtension();

                            // Store the file in the storage directory with the generated name
                            $imagePath = $image->storeAs('images', $fileName, 'public');

                            // Update the corresponding record in the database
                            $basicInfoRecord = $basicInfo->where('key', $key)->first();

                            if ($basicInfoRecord) {
                                if ($basicInfoRecord->update(['content' => $imagePath])) {
                                    $updateSuccessful = true; // Update was successful
                                }
                            }
                        } else {
                            return redirect()->back()->withInput()->with('flash.banner', 'Failed to upload Slider.');
                        }
                    } elseif (!str_ends_with($key, '_image')) {
                        // Update the corresponding record in the database
                        $basicInfoRecord = $basicInfo->where('key', $key)->first();

                        if ($basicInfoRecord) {
                            if ($basicInfoRecord->update(['content' => $request->input($key)])) {
                                $updateSuccessful = true; // Update was successful
                            }
                        }
                    }
                }
            }

            // Perform redirection based on the flag
            if ($updateSuccessful) {
                return redirect()->route('admin.basic-info.show')->with('flash.banner', 'Updated successfully!');
            } else {
                return redirect()->back()->withInput()->with('flash.banner', 'Failed to update.')->with('flash.bannerStyle', 'danger');
            }
        } catch (\Exception $e) {
            // Handle any exceptions that occur during the update
            return redirect()->back()->withInput()->with('flash.banner', 'An error occurred during the update: ' . $e->getMessage());
        }
    }
}
