<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Classroom;
use App\Models\Admin\Attendance;
use App\Models\Admin\Student;
use Inertia\Inertia;
class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->has('select_classroom')) {
            if ($request->input('select_classroom') === 'true') {
                // Logic to handle selecting a classroom before displaying Attendance
                $classrooms = Classroom::with(['grade', 'section', 'group'])->orderBy('name')->where('status', 1)->get();

                return Inertia::render('Admin/Attendances/ClassroomsList', [
                    'classrooms' => $classrooms,
                ]);
            }
        } else if ($request->has('selected_classroom')) {
            // Retrieve students list based on selected classroom
            $classrooms = Classroom::with(['grade', 'section', 'group'])->orderBy('name')->where('status', 1)->get();
            $selectedClassroom = Classroom::with(['grade', 'section', 'group'])->where('id', $request->input('selected_classroom'))->first();
            $students = Student::where('classroom_id', $selectedClassroom->id)
                ->orderBy('roll_no')
                ->with(['createdBy', 'updatedBy'])
                ->paginate(10);

            return Inertia::render('Admin/Attendances/Index', [
                'classrooms' => $classrooms,
                'students' => $students,
                'selected_classroom' => $selectedClassroom,
            ]);
        } else {
            // Redirect with the query string 'select_classroom=true'
            return redirect()->route('admin.attendances.index', ['select_classroom' => 'true']);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
