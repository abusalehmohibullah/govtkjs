<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\Admin\BasicInfoController;
use App\Http\Controllers\Admin\NoticeController;
use App\Http\Controllers\Admin\FaqController;
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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/login-options', function () {
    return Inertia::render('LoginOptions');
})->name('loginOptions');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    // Basic Information
    Route::prefix('basic-info')->group(function () {

        // Store Basic Information (form submission)
        Route::get('/', [BasicInfoController::class, 'show'])->name('admin.basic-info.show');

        // Route::post('/', [BasicInfoController::class, 'store'])->name('basic-info.store');

        // Update Basic Information (form submission)
        Route::put('/', [BasicInfoController::class, 'update'])->name('admin.basic-info.update');

    });

    Route::resource('notices', NoticeController::class, [
        'names' => 'admin.notices',
    ]);
    Route::resource('faqs', FaqController::class, [
        'names' => 'admin.faqs',
    ]);
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