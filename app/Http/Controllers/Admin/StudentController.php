<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Classroom;
use App\Models\Admin\Student;
use Inertia\Inertia;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->has('select_classroom')) {
            if ($request->input('select_classroom') === 'true') {
                // Logic to handle selecting a classroom before displaying students
                $classrooms = Classroom::orderBy('name')->where('status', 1)->get();

                return Inertia::render('Admin/Students/ClassroomsList', [
                    'classrooms' => $classrooms,
                ]);
            }
        } else if ($request->has('selected_classroom')) {
            // Retrieve students list based on selected classroom
            $selectedClassroom = $request->input('selected_classroom');
            $students = Student::where('classroom_id', $selectedClassroom)
                ->orderBy('roll_number')
                ->with(['createdBy', 'updatedBy'])
                ->paginate(10);

            return Inertia::render('Admin/Students/Index', [
                'students' => $students,
                'selected_classroom' => $selectedClassroom,
            ]);
        } else {
            // Redirect with the query string 'select_classroom=true'
            return redirect()->route('admin.students.index', ['select_classroom' => 'true']);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $selectedClassroom = $request->input('selected_classroom');
        $classroom = Classroom::where('id', $selectedClassroom)
        ->with(['grade', 'section', 'group'])->first();

        return Inertia::render('Admin/Students/Create', [
            'classroom' => $classroom,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
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
