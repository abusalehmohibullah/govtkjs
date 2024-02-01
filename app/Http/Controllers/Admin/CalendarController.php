<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Calendar;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
        
class CalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        // Retrieve paginated records from the calendars table
        $calendars = Calendar::latest()
            ->with(['createdBy', 'updatedBy'])
            ->paginate(10);

        // Pass the paginated data to the Inertia view
        return Inertia::render('Admin/Calendars/Index', [
            'calendars' => $calendars,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Show the form for create
        return Inertia::render('Admin/Calendars/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        // Define validation rules
        $validationRules = [
            'title' => 'required',
            'type' => 'required',
            'start_date' => 'required',
            'end_date' => 'nullable',
            'color' => 'nullable',
            'description' => 'nullable',
            'class_off' => ['required', Rule::in(['0', '1'])],
        ];

        // Custom error messages for validation
        $customMessages = [
            'type.required' => 'Please select a type.',
            'title.required' => 'Please provide a title.',
            'start_date.required' => 'Please provide a starting date.',            
            'class_off.required' => 'Please select an option.',
        ];


        // Validate the incoming request data
        $validatedData = $request->validate($validationRules, $customMessages);

        // Create a new model and populate it with validated data
        $calendar = new Calendar;
        $calendar->fill($validatedData);

        $calendar->created_by = auth()->id();


        try {
            // Save the model
            if ($calendar->save()) {
                return redirect()->route('admin.calendars.index')->with('flash.banner', 'Event created successfully!');
            } else {
                return redirect()->back()->withInput()->with('flash.banner', 'Failed to create Event.')->with('flash.bannerStyle', 'danger');
            }
        } catch (\Exception $e) {
            // Handle the error
            return redirect()->back()->withInput()->with('flash.banner', $e->getMessage())->with('flash.bannerStyle', 'danger');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Calendar $calendar)
    {

        // Pass the paginated data to the Inertia view
        return Inertia::render('Admin/Calendars/Edit', [
            'calendar' => $calendar,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Calendar $calendar)
    {
        // dd($request);
        // Define validation rules
        $validationRules = [
            'title' => 'required',
            'type' => 'required',
            'start_date' => 'required',
            'end_date' => 'nullable',
            'color' => 'nullable',
            'description' => 'nullable',
            'class_off' => ['required', Rule::in(['0', '1'])],
        ];

        // Custom error messages for validation
        $customMessages = [
            'type.required' => 'Please select a type.',
            'title.required' => 'Please provide a title.',
            'start_date.required' => 'Please provide a starting date.',
            'class_off.required' => 'Please select an option.',
        ];


        // Validate the incoming request data
        $validatedData = $request->validate($validationRules, $customMessages);

        // Create a new model and populate it with validated data
        $calendar->update($validatedData);
        $calendar->updated_by = auth()->id();


        try {
            // Save the model
            if ($calendar->save()) {
                return redirect()->route('admin.calendars.index')->with('flash.banner', 'Event updated successfully!');
            } else {
                return redirect()->back()->withInput()->with('flash.banner', 'Failed to update Event.')->with('flash.bannerStyle', 'danger');
            }
        } catch (\Exception $e) {
            // Handle the error
            return redirect()->back()->withInput()->with('flash.banner', $e->getMessage())->with('flash.bannerStyle', 'danger');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Calendar $calendar)
    {
         // Delete the notice
         $calendar->delete();

         // Redirect to the notice index page with a success message
         return redirect()->route('admin.calendars.index')->with('flash.banner', 'Event deleted successfully!');
    }

    public function status(Request $request, Calendar $calendar)
    {
        if ($request->input('status') === 1) {
            $calendar->status = 0;
            $message = 'Event is hidden now!';
        } else {
            $calendar->status = 1;
            $message = 'Event is visible to all!';
        }
        $calendar->updated_by = auth()->id();

        if ($calendar->save()) {
            return redirect()->route('admin.calendars.index')->with('flash.banner', $message);
        } else {
            return redirect()->back()->with('flash.banner', 'Failed to update Visibility.');
        }
    }
}
