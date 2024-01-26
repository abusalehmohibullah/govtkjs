<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Classroom;
use App\Models\Admin\Student;
use Inertia\Inertia;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
                $classrooms = Classroom::with(['grade', 'section', 'group'])->orderBy('name')->where('status', 1)->get();

                return Inertia::render('Admin/Students/ClassroomsList', [
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

            return Inertia::render('Admin/Students/Index', [
                'classrooms' => $classrooms,
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
        // dd($request);
        // Define validation rules
        $validationRules = [
            // 'student_id' => 'required|unique:students',
            'session' => 'required',
            'unique_id' => 'nullable',
            'roll_no' => 'nullable',
            'registration_no' => 'nullable',
            'student_name_en' => 'required',
            'student_name_bn' => 'required',
            'father_name_en' => 'required',
            'father_name_bn' => 'required',
            'mother_name_en' => 'required',
            'mother_name_bn' => 'required',
            'guardian_name_en' => 'nullable',
            'guardian_name_bn' => 'nullable',
            'date_of_birth' => 'required|date',
            'brid' => 'required|digits:17',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:20000',
            'email' => 'nullable|email',
            'student_mobile_no' => 'required|digits:11',
            'father_mobile_no' => 'nullable|digits:11',
            'mother_mobile_no' => 'nullable|digits:11',
            'guardian_mobile_no' => 'nullable|digits:11',
            'address_en' => 'nullable',
            'address_bn' => 'nullable',
            'gender_en' => 'required|in:Male,Female,Others',
            'gender_bn' => 'required|in:বালক,বালিকা,অন্যান্য',
            'religion_en' => 'required|in:Islam,Hinduism,Buddhism,Christianity,Others',
            'religion_bn' => 'required|in:ইসলাম,হিন্দু,বৌদ্ধ,খ্রিষ্টান,অন্যান্য',
            'disability_status_en' => 'nullable|in:None,Physical,Visual,Hearing,Verbal,Intellectual,Others',
            'disability_status_bn' => 'nullable|in:প্রযোজ্য নয়,শারীরিক প্রতিবন্ধী,দৃষ্টি প্রতিবন্ধী,শ্রবণ প্রতিবন্ধী,বাক প্রতিবন্ধী,বুদ্ধি প্রতিবন্ধী,অন্যান্য',
            'classroom_id' => 'nullable|exists:classrooms,id',
        ];

        // Custom error messages for validation
        $customMessages = [
            // 'unique_id.required' => 'Please provide a student ID.',
            // 'unique_id.unique' => 'This unique ID is already in use.',
            'session.required' => 'Please select a session.',
            'student_name_en.required' => 'Please provide the student name in English.',
            'student_name_bn.required' => 'Please provide the student name in Bengali.',
            'father_name_en.required' => 'Please provide the father name in English.',
            'father_name_bn.required' => 'Please provide the father name in Bengali.',
            'mother_name_en.required' => 'Please provide the mother name in English.',
            'mother_name_bn.required' => 'Please provide the mother name in Bengali.',
            'date_of_birth.required' => 'Please provide a valid date of birth.',
            'date_of_birth.date' => 'Date of birth must be a valid date.',
            'brid.required' => 'Please provide a valid Birth Regestration ID.',
            'brid.digits' => 'Birth registration ID should be 17 digits long.',
            'photo.required' => 'Please upload an image.',
            'photo.image' => 'The file must be an image.',
            'photo.mimes' => 'The file must be a JPEG, PNG, JPG, or GIF.',
            'photo.max' => 'The file size must be less than 200KB.',
            'student_mobile_no.required' => 'Please provide the student mobile number.',
            'student_mobile_no.digits' => 'Student mobile number should be 11 digits.',
            'father_mobile_no.digits' => 'Father mobile number should be 11 digits.',
            'mother_mobile_no.digits' => 'Mother mobile number should be 11 digits.',
            'guardian_mobile_no.digits' => 'Guardian mobile number should be 11 digits.',
            'gender_en.required' => 'Please select a valid gender.',
            'gender_en.in' => 'Please select a valid gender.',
            'gender_bn.required' => 'Please select a valid gender.',
            'gender_bn.in' => 'Please select a valid gender.',
            'religion_en.required' => 'Please select a valid religion.',
            'religion_en.in' => 'Please select a valid religion.',
            'religion_bn.required' => 'Please select a valid religion.',
            'religion_bn.in' => 'Please select a valid religion.',
            'disability_status_en.in' => 'Please select a valid disability status.',
            'disability_status_bn.in' => 'Please select a valid disability status.',
            'classroom_id.exists' => 'Selected classroom does not exist.',
            // Add more messages for other fields as needed...
        ];


        // Validate the incoming request data
        $validatedData = $request->validate($validationRules, $customMessages);
        $studentID =  $this->generateStudentID($request->grade, $request->input('session'));
        // dd($studentID);
        // Create a new model and populate it with validated data
        $student = new Student;
        $student->fill($validatedData);

        $student->created_by = auth()->id();

        $student->student_id = $studentID;

        try {
            DB::beginTransaction();

            if ($request->hasFile('photo')) {
                // Get the uploaded file from the request
                $photo = $request->file('photo');

                // Validate the file size and type
                if ($photo->isValid()) {
                    $manager = new ImageManager(new Driver());
                    $image = $manager->read($photo);

                    $image->cover(480, 600);

                    // Generate a unique name for the file based on the slug and the file extension
                    $fileName = $studentID . '.jpeg';

                    // Store the file in the storage directory with the generated name
                    $image->toJpeg()->save(public_path('storage/students/' . $fileName));

                    // Save the file photo in the database
                    $student->photo = 'students/' . $fileName;
                } else {
                    throw new \Exception('Failed to upload Photo.');
                }
            }

            // Save the model
            if ($student->save()) {
                DB::commit();
                return redirect()->route('admin.students.index', ['selected_classroom' => $student->classroom_id])->with('flash.banner', 'Student added successfully!');
            } else {
                // If saving fails, roll back the transaction and delete the uploaded image
                DB::rollBack();

                if (isset($fileName) && file_exists(public_path('storage/students/' . $fileName))) {
                    unlink(public_path('storage/students/' . $fileName));
                }

                return redirect()->back()->withInput()->with('flash.banner', 'Failed to add student.');
            }
        } catch (\Exception $e) {
            // Handle the error and delete the uploaded image if it exists
            if (isset($fileName) && file_exists(public_path('storage/students/' . $fileName))) {
                unlink(public_path('storage/students/' . $fileName));
            }

            // Roll back the transaction
            DB::rollBack();

            return redirect()->back()->withInput()->with('flash.banner', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Student $student)
    {
        $classroom = Classroom::where('id', $student->classroom_id)->with(['grade', 'section', 'group'])->first();
        return Inertia::render('Admin/Students/Show', [
            'classroom' => $classroom,
            'student' => $student,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Student $student)
    {

        $classrooms = Classroom::where('status', 1)->orderBy('name')->get();

        // dd($classrooms);
        return Inertia::render('Admin/Students/Edit', [
            'classrooms' => $classrooms,
            'student' => $student,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        // dd($request);
        // Define validation rules
        $validationRules = [
            // 'student_id' => 'required|unique:students',
            'session' => 'required',
            'unique_id' => 'nullable',
            'roll_no' => 'nullable',
            'registration_no' => 'nullable',
            'student_name_en' => 'required',
            'student_name_bn' => 'required',
            'father_name_en' => 'required',
            'father_name_bn' => 'required',
            'mother_name_en' => 'required',
            'mother_name_bn' => 'required',
            'guardian_name_en' => 'nullable',
            'guardian_name_bn' => 'nullable',
            'date_of_birth' => 'required|date',
            'brid' => 'required|digits:17',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:20000',
            'email' => 'nullable|email',
            'student_mobile_no' => 'required|digits:11',
            'father_mobile_no' => 'nullable|digits:11',
            'mother_mobile_no' => 'nullable|digits:11',
            'guardian_mobile_no' => 'nullable|digits:11',
            'address_en' => 'nullable',
            'address_bn' => 'nullable',
            'gender_en' => 'required|in:Male,Female,Others',
            'gender_bn' => 'required|in:বালক,বালিকা,অন্যান্য',
            'religion_en' => 'required|in:Islam,Hinduism,Buddhism,Christianity,Others',
            'religion_bn' => 'required|in:ইসলাম,হিন্দু,বৌদ্ধ,খ্রিষ্টান,অন্যান্য',
            'disability_status_en' => 'nullable|in:None,Physical,Visual,Hearing,Verbal,Intellectual,Others',
            'disability_status_bn' => 'nullable|in:প্রযোজ্য নয়,শারীরিক প্রতিবন্ধী,দৃষ্টি প্রতিবন্ধী,শ্রবণ প্রতিবন্ধী,বাক প্রতিবন্ধী,বুদ্ধি প্রতিবন্ধী,অন্যান্য',
            'classroom_id' => 'nullable|exists:classrooms,id',
        ];

        // Custom error messages for validation
        $customMessages = [
            // 'unique_id.required' => 'Please provide a student ID.',
            // 'unique_id.unique' => 'This unique ID is already in use.',
            'session.required' => 'Please select a session.',
            'student_name_en.required' => 'Please provide the student name in English.',
            'student_name_bn.required' => 'Please provide the student name in Bengali.',
            'father_name_en.required' => 'Please provide the father name in English.',
            'father_name_bn.required' => 'Please provide the father name in Bengali.',
            'mother_name_en.required' => 'Please provide the mother name in English.',
            'mother_name_bn.required' => 'Please provide the mother name in Bengali.',
            'date_of_birth.required' => 'Please provide a valid date of birth.',
            'date_of_birth.date' => 'Date of birth must be a valid date.',
            'brid.required' => 'Please provide a valid Birth Regestration ID.',
            'brid.digits' => 'Birth registration ID should be 17 digits long.',
            'photo.image' => 'The file must be an image.',
            'photo.mimes' => 'The file must be a JPEG, PNG, JPG, or GIF.',
            'photo.max' => 'The file size must be less than 200KB.',
            'student_mobile_no.required' => 'Please provide the student mobile number.',
            'student_mobile_no.digits' => 'Student mobile number should be 11 digits.',
            'father_mobile_no.digits' => 'Father mobile number should be 11 digits.',
            'mother_mobile_no.digits' => 'Mother mobile number should be 11 digits.',
            'guardian_mobile_no.digits' => 'Guardian mobile number should be 11 digits.',
            'gender_en.required' => 'Please select a valid gender.',
            'gender_en.in' => 'Please select a valid gender.',
            'gender_bn.required' => 'Please select a valid gender.',
            'gender_bn.in' => 'Please select a valid gender.',
            'religion_en.required' => 'Please select a valid religion.',
            'religion_en.in' => 'Please select a valid religion.',
            'religion_bn.required' => 'Please select a valid religion.',
            'religion_bn.in' => 'Please select a valid religion.',
            'disability_status_en.in' => 'Please select a valid disability status.',
            'disability_status_bn.in' => 'Please select a valid disability status.',
            'classroom_id.exists' => 'Selected classroom does not exist.',
            // Add more messages for other fields as needed...
        ];



        // Validate the incoming request data
        $validatedData = $request->validate($validationRules, $customMessages);
        if ($request->classroom_id != $student->classroom_id) {
            $oldClass = Classroom::where('id', $student->classroom_id)
                ->with(['grade'])->first();
            $newClass = Classroom::where('id', $request->classroom_id)
                ->with(['grade'])->first();
            if ($oldClass->grade->name != $newClass->grade->name) {
                $studentID =  $this->generateStudentID($newClass->grade->name, $request->input('session'));
                $student->student_id = $studentID;
            }
        }
        // dd($studentID);
        // Create a new model and populate it with validated data
        // $student = new Student;
        $oldPhoto = $student->photo;

        $student->update($validatedData);

        $student->photo = $oldPhoto;
        $student->updated_by = auth()->id();


        try {
            DB::beginTransaction();

            if ($request->hasFile('photo')) {
                // Get the uploaded file from the request
                $photo = $request->file('photo');

                // Validate the file size and type
                if ($photo->isValid()) {
                    $manager = new ImageManager(new Driver());
                    $image = $manager->read($photo);

                    $image->cover(480, 600);

                    // Generate a unique name for the file based on the slug and the file extension
                    $fileName = $student->student_id . '.jpeg';

                    // Store the file in the storage directory with the generated name
                    $image->toJpeg()->save(public_path('storage/students/' . $fileName));

                    // Save the file photo in the database
                    $student->photo = 'students/' . $fileName;
                } else {
                    throw new \Exception('Failed to upload Photo.');
                }
            }

            // Save the model
            if ($student->save()) {
                DB::commit();
                return redirect()->route('admin.students.index', ['selected_classroom' => $student->classroom_id])->with('flash.banner', 'Student updated successfully!');
            } else {
                // If saving fails, roll back the transaction and delete the uploaded image
                DB::rollBack();

                if (isset($fileName) && file_exists(public_path('storage/students/' . $fileName))) {
                    unlink(public_path('storage/students/' . $fileName));
                }

                return redirect()->back()->withInput()->with('flash.banner', 'Failed to update student.');
            }
        } catch (\Exception $e) {
            // Handle the error and delete the uploaded image if it exists
            if (isset($fileName) && file_exists(public_path('storage/students/' . $fileName))) {
                unlink(public_path('storage/students/' . $fileName));
            }

            // Roll back the transaction
            DB::rollBack();

            return redirect()->back()->withInput()->with('flash.banner', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        // Delete the path file if it exists
        if ($student->photo) {
            Storage::disk('public')->delete($student->photo);
        }

        // Delete the slider
        $student->delete();

        // Redirect to the slider index page with a success message
        return redirect()->route('admin.students.index', ['selected_classroom' => $student->classroom_id])->with('flash.banner', 'Student deleted successfully!');
    }

    private function generateStudentID($grade, $session)
    {
        // Determine the starting year based on the grade
        if ($grade < 11) {
            $lastTwoDigits = substr($session, -2);

            $startYear = $lastTwoDigits - ($grade - 6); // Assuming the first class is grade 6

            // Get the last assigned ID for the given starting year
            $lastID = Student::where('student_id', 'like', "S$startYear%")
                ->orderBy('student_id', 'desc')
                ->value('student_id');

            // Increment the last ID or start with 0001 if no ID found for the year
            if ($lastID) {
                $sequentialPart = intval(substr($lastID, -4)) + 1;
                $sequentialPart = str_pad($sequentialPart, 4, '0', STR_PAD_LEFT);
            } else {
                $sequentialPart = '0001';
            }

            return "S$startYear$sequentialPart"; // Construct the new student ID

        } else {
            $lastTwoDigits = substr($session, -2) - 1;

            $startYear = $lastTwoDigits - ($grade - 11); // Assuming the first class is grade 6

            // Get the last assigned ID for the given starting year
            $lastID = Student::where('student_id', 'like', "C$startYear%")
                ->orderBy('student_id', 'desc')
                ->value('student_id');
            // Increment the last ID or start with 0001 if no ID found for the year
            if ($lastID) {
                $sequentialPart = intval(substr($lastID, -4)) + 1;
                $sequentialPart = str_pad($sequentialPart, 4, '0', STR_PAD_LEFT);
            } else {
                $sequentialPart = '0001';
            }

            return "C$startYear$sequentialPart"; // Construct the new student ID
        }
    }
}
