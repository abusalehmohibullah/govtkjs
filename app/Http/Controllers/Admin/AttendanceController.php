<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Classroom;
use App\Models\Admin\Attendance;
use App\Models\Admin\Student;
use Inertia\Inertia;
use Illuminate\Support\Carbon;

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


            // Assuming $classroomId is the ID of the selected classroom
            $classroomId = $request->input('selected_classroom');
            // Determine the month based on the request or use the current month
            $month = $request->input('month', Carbon::now()->month);
            // Retrieve students list based on selected classroom
            $classrooms = Classroom::with(['grade', 'section', 'group'])->orderBy('name')->where('status', 1)->get();
            $selectedClassroom = Classroom::with(['grade', 'section', 'group'])->find($request->input('selected_classroom'));

            // Retrieve students for the selected classroom
            $students = Student::where('classroom_id', $classroomId)
                ->orderBy('roll_no')
                ->with(['createdBy', 'updatedBy', 'attendances' => function ($query) use ($month) {
                    $query->whereMonth('attendance_date', $month)->orderBy('attendance_date');
                }])
                ->paginate(10);


            // Get the start and end dates of the month
            $startDate = Carbon::create(null, $month, 1)->startOfMonth();
            $endDate = $startDate->copy()->endOfMonth();

            // Retrieve unique dates from the Attendance table for the current month
            $uniqueDates = Attendance::where('classroom_id', $classroomId)
                ->whereBetween('attendance_date', [$startDate, $endDate])
                ->pluck('attendance_date')
                ->unique();

                $workingDays = $uniqueDates->map(function ($date) {
                    return Carbon::parse($date)->day;
                })->sort()->values()->toArray();

            return Inertia::render('Admin/Attendances/Index', [
                'classrooms' => $classrooms,
                'students' => $students,
                'selected_classroom' => $selectedClassroom,
                'working_days' => $workingDays,
                'selected_month' => $month,
            ]);

        } else {
            // Redirect with the query string 'select_classroom=true'
            return redirect()->route('admin.attendances.index', ['select_classroom' => 'true']);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $selectedClassroom = $request->input('selected_classroom');
        $students = Student::where('classroom_id', $selectedClassroom)->orderBy('roll_no')->get();

        return Inertia::render('Admin/Students/Create', [
            'students' => $students,
        ]);
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
