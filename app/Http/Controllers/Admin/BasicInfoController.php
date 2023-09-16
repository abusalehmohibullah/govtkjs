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
        // Retrieve the keys as an array from the request
        $keysArray = $request->keys();

        // Retrieve all records from the basic_info table
        $basicInfo = BasicInfo::all();
    
        // Loop through the keys
        foreach ($keysArray as $key) {
            // Check if the key exists in the request data
            if ($request->has($key)) {
                // Update the corresponding record in the database
                $basicInfoRecord = $basicInfo->where('key', $key)->first();
                
                if ($basicInfoRecord) {
                    
                    if ($basicInfoRecord->update(['content' => $request->input($key)])) {
                        return redirect()->route('admin.basic-info.show')->with('flash.banner', 'Updated successfully!');
                    } else {
                        return redirect()->back()->withInput()->with('flash.banner', 'Failed to Update.');
                    }
                }
            }
        }

    }
    
}
