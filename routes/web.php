<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\UserController;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use App\Http\Controllers\Admin\UserInvitationController;
use App\Http\Controllers\Admin\BasicInfoController;
use App\Http\Controllers\Admin\NoticeController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\AlbumController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\BuildingController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\ClassroomController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\GradeController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\GroupController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\AttendanceController;
use App\Http\Controllers\Admin\CalendarController;

use App\Models\Admin\BasicInfo;
use App\Models\Admin\Notice;
use App\Models\Admin\Faq;
use App\Models\Admin\Slider;
use App\Models\Admin\Album;
use App\Models\Admin\Media;
use App\Models\Admin\Grade;
use App\Models\Admin\Subject;
use App\Models\Admin\Group;
use App\Models\Admin\Classroom;
use App\Models\Admin\Student;
use App\Models\Admin\Teacher;
use App\Models\Admin\Calendar;
use Illuminate\Support\Facades\Artisan;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });


// Route::middleware(['auth'])->group(function () {
//     Route::get('/role-permission', [RolePermissionController::class, 'index'])->name('role-permission.index');
//     // Add more routes for editing, creating roles, permissions, etc.
// });

// require_once __DIR__ . '/fortify.php';
// require_once __DIR__ . '/jetstream.php';
//declared in route service provider

Route::get('/', function () {
    // Fetch data from multiple tables using Eloquent or database queries
    $infos = BasicInfo::get();

    $notices = Notice::where('status', 1) // Filter by status = 1
        ->latest('created_at') // Order by created_at in descending order
        ->get();

    $scrolls = Notice::where('status', 1) // Filter by status = 1
        ->where('scroll', '1') // Add your additional condition here
        ->latest('created_at') // Order by created_at in descending order
        ->get();


    $faqs = Faq::where('status', 1) // Filter by status = 1
        ->orderBy('priority') // Order by priority
        ->get();

    $albums = Album::with('media')
        ->latest('created_at') // Order by created_at in descending order
        ->take(10)             // Limit the result to the first 10 albums
        ->get();

    $events = Calendar::where('status', 1)
        ->whereYear('start_date', now()->year) // Filter by status = 1
        ->orderBy('start_date') // Order by
        ->get();

    $sliders = Slider::where('status', 1)
        ->orderBy('priority') // Order by priority
        ->get()
        ->map(function ($slider) {
            return [
                'path' => asset('storage/' . $slider->path),
                'caption' => $slider->caption,
            ];
        });




    // Pass the fetched data to the Inertia view
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
        'infos' => $infos->pluck('content', 'key')->toArray(),
        'faqs' => $faqs,
        'scrolls' => $scrolls,
        'notices' => $notices,
        'sliders' => $sliders,
        'albums' => $albums,
        'events' => $events,
    ]);
})->name('home');


Route::get('/albums', function () {

    $albums = Album::with('media')
        ->latest('created_at') // Order by created_at in descending order
        ->take(10)             // Limit the result to the first 10 albums
        ->get();

    // Pass the fetched data to the Inertia view
    return Inertia::render('Albums', [
        'albums' => $albums,
    ]);
})->name('albums');

Route::get('/admission', function () {
    return Inertia::render('Admission');
})->name('admission');

Route::get('/teachers', function () {
    $teachers = Teacher::with(['user' => function ($query) {
        $query->orderBy('name');
    }])->orderBy('priority')->get()->groupBy('designation');

    return Inertia::render('Teachers', [
        'teachers' => $teachers,
    ]);
})->name('teachers');

Route::get('/career', function () {
    return Inertia::render('Career');
})->name('career');

Route::get('/contact', function () {
    return Inertia::render('Contact');
})->name('contact');

Route::get('/login-options', function () {
    return Inertia::render('LoginOptions');
})->name('loginOptions');

Route::get('/students-portal', function () {
    return Inertia::render('StudentsPortal');
})->name('students-portal');

Route::get('/result', function () {
    return Inertia::render('Result');
})->name('result');


Route::get('/notices', function () {

    $notices = Notice::where('status', 1)->orderBy('published_on', 'desc')->paginate(10);

    return Inertia::render('Notices', [
        'notices' => $notices,
    ]);
})->name('notices.index');

Route::get('/notice/{slug}', function ($slug) {

    $notice = Notice::where('slug', $slug)->first();

    return Inertia::render('Notice', [
        'notice' => $notice,
    ]);
})->name('notice.show');
Route::get('notices/{notice}/download', [NoticeController::class, 'download'])->name('notice.download');

Route::get('/history', function () {

    $history_title = BasicInfo::where('key', 'history_title')->first();
    $history_content = BasicInfo::where('key', 'history_content')->first();

    return Inertia::render('History', [
        'history_title' => $history_title,
        'history_content' => $history_content,
    ]);
})->name('history.show');

Route::get('/message1', function () {

    $message_1_title = BasicInfo::where('key', 'message_1_title')->first();
    $message_1_content = BasicInfo::where('key', 'message_1_content')->first();
    $message_1_image = BasicInfo::where('key', 'message_1_image')->first();

    return Inertia::render('Message1', [
        'message_1_title' => $message_1_title,
        'message_1_content' => $message_1_content,
        'message_1_image' => $message_1_image,
    ]);
})->name('message_1.show');

Route::get('/message2', function () {

    $message_2_title = BasicInfo::where('key', 'message_2_title')->first();
    $message_2_content = BasicInfo::where('key', 'message_2_content')->first();
    $message_2_image = BasicInfo::where('key', 'message_2_image')->first();

    return Inertia::render('Message2', [
        'message_2_title' => $message_2_title,
        'message_2_content' => $message_2_content,
        'message_2_image' => $message_2_image,
    ]);
})->name('message_2.show');

Route::prefix('admin')->middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {


    // Route::get('/role-permission', [RolePermissionController::class, 'index'])->name('role-permission.index');
    // Route::post('/role-permission/update', [RolePermissionController::class, 'updatePermissions'])->name('role-permission.update');


    // Show a list of all users
    // Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');

    // edit an individual user's details
    // Route::get('/users/create', [UserController::class, 'create'])->name('admin.users.create');
    // Route::post('/users', [UserController::class, 'store'])->name('admin.users.store');

    // edit an individual user's details
    // Route::get('/users/{user}', [UserController::class, 'edit'])->name('admin.users.edit');

    // Route::put('/users/{user}', [UserController::class, 'update'])->name('admin.users.update');



    // Dashboard
    Route::get('/dashboard', function () {
        $user = auth()->user();
        $classroom = null;
        if ($user) {
            $teacher = $user->teacher;

            if ($teacher) {
                $classroom = $teacher->classroom;
                if ($classroom) {
                    // Eager load related models (Grade, Section, Group)
                    $classroom = $classroom->load(['grade', 'section', 'group']);
                }
            }
        }

        return Inertia::render('Dashboard', [
            'classroom' => $classroom,
            // 'message_2_content' => $message_2_content,
            // 'message_2_image' => $message_2_image,
        ]);
    })->name('dashboard');

    Route::resource('users', UserController::class, [
        'names' => 'admin.users',
    ]);

    Route::resource('user-invitations', UserInvitationController::class, [
        'names' => 'admin.user-invitations',
    ]);
    Route::put('user-invitations/{user_invitation}/resend', [UserInvitationController::class, 'resend'])->name('admin.user-invitations.resend');

    // Basic Information
    Route::middleware(['restriction:operator,manage_basic_infos'])->group(function () {
        Route::prefix('basic-info')->group(function () {

            // Store Basic Information (form submission)
            Route::get('/', [BasicInfoController::class, 'show'])->name('admin.basic-info.show');

            // Route::post('/', [BasicInfoController::class, 'store'])->name('basic-info.store');

            // Update Basic Information (form submission)
            Route::put('/', [BasicInfoController::class, 'update'])->name('admin.basic-info.update');
        });
    });
    Route::middleware(['restriction:clerk,manage_notices'])->group(function () {
        Route::resource('notices', NoticeController::class, [
            'names' => 'admin.notices',
        ]);
        Route::put('notices/{notice}/status', [NoticeController::class, 'status'])->name('admin.notices.status');
        Route::get('notices/{notice}/download', [NoticeController::class, 'download'])->name('admin.notices.download');
    });

    Route::middleware(['restriction:operator,manage_faqs'])->group(function () {
        Route::resource('faqs', FaqController::class, [
            'names' => 'admin.faqs',
        ]);
        Route::put('faqs/{faq}/status', [FaqController::class, 'status'])->name('admin.faqs.status');
    });

    Route::middleware(['restriction:operator,manage_sliders'])->group(function () {
        Route::resource('sliders', SliderController::class, [
            'names' => 'admin.sliders',
        ]);
        Route::put('sliders/{slider}/status', [SliderController::class, 'status'])->name('admin.sliders.status');
    });

    Route::middleware(['restriction:operator,manage_albums'])->group(function () {
        Route::resource('albums', AlbumController::class, [
            'names' => 'admin.albums',
        ]);
        Route::put('albums/{album}/status', [AlbumController::class, 'status'])->name('admin.albums.status');

        Route::resource('albums.media', MediaController::class, [
            'names' => 'admin.albums.media',
        ]);
        Route::put('notices/{notice}/status', [NoticeController::class, 'status'])->name('admin.notices.status');
    });

    Route::middleware(['restriction:operator,manage_branches'])->group(function () {
        Route::resource('branches', BranchController::class, [
            'names' => 'admin.branches',
        ]);
        Route::put('branches/{branch}/status', [BranchController::class, 'status'])->name('admin.branches.status');
    });

    Route::middleware(['restriction:operator,manage_buildings'])->group(function () {
        Route::resource('buildings', BuildingController::class, [
            'names' => 'admin.buildings',
        ]);
        Route::put('buildings/{building}/status', [BuildingController::class, 'status'])->name('admin.buildings.status');
    });

    Route::middleware(['restriction:operator,manage_rooms'])->group(function () {
        Route::resource('rooms', RoomController::class, [
            'names' => 'admin.rooms',
        ]);
        Route::put('rooms/{room}/status', [RoomController::class, 'status'])->name('admin.rooms.status');
    });

    Route::middleware(['restriction:operator,manage_classrooms'])->group(function () {
        Route::resource('classrooms', ClassroomController::class, [
            'names' => 'admin.classrooms',
        ]);
        Route::put('classrooms/{classroom}/status', [ClassroomController::class, 'status'])->name('admin.classrooms.status');
    });

    Route::middleware(['restriction:operator,manage_sections'])->group(function () {
        Route::resource('sections', SectionController::class, [
            'names' => 'admin.sections',
        ]);
        Route::put('sections/{section}/status', [SectionController::class, 'status'])->name('admin.sections.status');
    });

    Route::middleware(['restriction:operator,manage_grades'])->group(function () {
        Route::resource('grades', GradeController::class, [
            'names' => 'admin.grades',
        ]);
        Route::put('grades/{grade}/status', [GradeController::class, 'status'])->name('admin.grades.status');
    });

    Route::middleware(['restriction:operator,manage_subjects'])->group(function () {
        Route::resource('subjects', SubjectController::class, [
            'names' => 'admin.subjects',
        ]);
        Route::put('subjects/{subject}/status', [SubjectController::class, 'status'])->name('admin.subjects.status');
    });

    Route::middleware(['restriction:operator,manage_groups'])->group(function () {
        Route::resource('groups', GroupController::class, [
            'names' => 'admin.groups',
        ]);
        Route::put('groups/{group}/status', [GroupController::class, 'status'])->name('admin.groups.status');
    });

    Route::middleware(['restriction:teacher,manage_students'])->group(function () {
        Route::resource('students', StudentController::class, [
            'names' => 'admin.students',
        ]);
        Route::put('students/{student}/status', [StudentController::class, 'status'])->name('admin.students.status');
    });

    Route::middleware(['restriction:operator,manage_teachers'])->group(function () {
        Route::resource('teachers', TeacherController::class, [
            'names' => 'admin.teachers',
        ]);
        Route::put('teachers/{teacher}/status', [TeacherController::class, 'status'])->name('admin.teachers.status');
    });

    Route::middleware(['restriction:teacher,manage_attendances'])->group(function () {
        Route::resource('attendances', AttendanceController::class, [
            'names' => 'admin.attendances',
        ]);
        Route::put('attendances/{attendance}/status', [AttendanceController::class, 'status'])->name('admin.attendances.status');
    });

    Route::middleware(['restriction:clerk,manage_calendars'])->group(function () {
        Route::resource('calendars', CalendarController::class, [
            'names' => 'admin.calendars',
        ]);
        Route::put('calendars/{calendar}/status', [CalendarController::class, 'status'])->name('admin.calendars.status');
    });

    Route::get('/id-cards/{id_card}', function ($id_card) {
        // Assuming 'student_id' is the column in the Student model for student identifier
        $student = Student::where('student_id', $id_card)->first();

        if (!$student) {
            // Handle the case when the student is not found
            abort(404, 'Student not found');
        }

        $classroom = Classroom::where('id', $student->classroom_id)->with(['grade', 'section', 'group'])->first();

        return Inertia::render('Admin/Layouts/IdCard', [
            'classroom' => $classroom,
            'student' => $student,
        ]);
    })->name('id-cards.show');
});


    



// Route::get('/run-migrations', function () {
//     try {
//         \Artisan::call('migrate');
//         return 'Migrations successfully executed.';
//     } catch (\Exception $e) {
//         return 'Error running migrations: ' . $e->getMessage();
//     }
// });

// Route::get('/clear-cache', function () {
//     try {
//         \Artisan::call('cache:clear');
//         return 'Cache cleared successfully.';
//     } catch (\Exception $e) {
//         return 'Error clearing cache: ' . $e->getMessage();
//     }
// });

// Route::get('/clear-routes', function () {
//     try {
//         \Artisan::call('route:clear');
//         return 'routes cleared successfully.';
//     } catch (\Exception $e) {
//         return 'Error clearing routes: ' . $e->getMessage();
//     }
// });

// Route::get('/clear-config', function () {
//     try {
//         \Artisan::call('config:clear');
//         return 'config cleared successfully.';
//     } catch (\Exception $e) {
//         return 'Error clearing config: ' . $e->getMessage();
//     }
// });

// Route::get('/optimize', function () {
//     try {
//         \Artisan::call('optimize');
//         return 'optimized successfully.';
//     } catch (\Exception $e) {
//         return 'Error optimizing: ' . $e->getMessage();
//     }
// });

// Route::get('/create-link', function () {
//     try {
//         \Artisan::call('storage:link');
//         return 'link created successfully.';
//     } catch (\Exception $e) {
//         return 'Error clearing cache: ' . $e->getMessage();
//     }
// });

// Route::get('/clear-cache-and-seed', function () {
//     try {
//         // Clear cache
//         \Artisan::call('cache:clear');

//         // Run database seed(s)
//         \Artisan::call('db:seed'); // Replace with specific seed command if needed

//         return 'Cache cleared and seeds executed successfully.';
//     } catch (\Exception $e) {
//         return 'Error: ' . $e->getMessage();
//     }
// });

// Route::get('/maintenance-mode/on', function () {
//     try {
//         \Artisan::call('down');
//         return 'Site is now in maintenance mode.';
//     } catch (\Exception $e) {
//         return 'Error putting site in maintenance mode: ' . $e->getMessage();
//     }
// });

// Route::get('/maintenance-mode/off', function () {
//     try {
//         \Artisan::call('up');
//         return 'Site is now live.';
//     } catch (\Exception $e) {
//         return 'Error taking site out of maintenance mode: ' . $e->getMessage();
//     }
// });