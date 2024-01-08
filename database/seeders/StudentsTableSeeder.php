<?php

namespace Database\Seeders;
use App\Models\Admin\Student;
use App\Models\Admin\Grade;
use App\Models\Admin\Section;
use App\Models\Admin\Group;
use App\Models\Admin\Classroom;
// use App\Models\Admin\Teacher;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentsTableSeeder extends Seeder
{
    public function run()
    {
        // Seed some grades, sections, groups, classrooms, and teachers if not already done
        // ...

        // Seed students
        $grades = Grade::all();
        $sections = Section::all();
        $groups = Group::all();
        $classrooms = Classroom::all();
        // $teachers = Teacher::all();

        foreach (range(1, 50) as $index) {
            $student = Student::create([
                'student_id' => '23' . str_pad($index, 4, '0', STR_PAD_LEFT), // Assuming 230001, 230002, ...
                'name' => 'Student Name ' . $index,
                'fathers_name' => 'Father Name ' . $index,
                'mothers_name' => 'Mother Name ' . $index,
                'date_of_birth' => now()->subYears(random_int(5, 18)), // Random age between 5 and 18
                'email' => 'student' . $index . '@example.com',
                'phone_number' => '1234567890',
                'address' => 'Address ' . $index,
                'grade_id' => $grades->random()->id,
                'section_id' => $sections->random()->id,
                'group_id' => $groups->random()->id,
                'classroom_id' => $classrooms->random()->id,
                // 'teacher_id' => $teachers->random()->id,
                'registration_number' => 'REG' . $index, // You can adjust the format as needed
                'roll_number' => 'ROLL' . $index, // You can adjust the format as needed
            ]);
        }
    }
}
