<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// ============================
// Public Routes
// ============================
Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// ============================
// Protected Routes
// ============================
Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Redirect dashboard sesuai role user
    Route::get('/dashboard', function () {
        $user = Auth::user();

        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard');
        } elseif ($user->isDosen()) {
            return redirect()->route('dosen.dashboard');
        } else {
            return redirect()->route('student.dashboard');
        }
    })->name('dashboard');

    // ============================
    // Admin Routes
    // ============================
    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

        // Student management
        Route::get('/students', [AdminController::class, 'students'])->name('students');
        Route::get('/students/create', [AdminController::class, 'createStudent'])->name('students.create');
        Route::post('/students', [AdminController::class, 'storeStudent'])->name('students.store');
        Route::get('/students/{student}/edit', [AdminController::class, 'editStudent'])->name('students.edit');
        Route::put('/students/{student}', [AdminController::class, 'updateStudent'])->name('students.update');
        Route::delete('/students/{student}', [AdminController::class, 'deleteStudent'])->name('students.delete');

        // Course management → pakai resource biar lengkap
        Route::resource('courses', CourseController::class);
    });

    // ============================
    // Dosen Routes
    // ============================
    Route::middleware(['role:dosen'])->prefix('dosen')->name('dosen.')->group(function () {
        Route::get('/dashboard', [DosenController::class, 'dashboard'])->name('dashboard');
        Route::get('/courses/{course}/students', [DosenController::class, 'courseStudents'])->name('courses.students');
        Route::put('/grades/{take}', [DosenController::class, 'updateGrade'])->name('grades.update');
    });

    // ============================
    // Student Routes
    // ============================
    Route::middleware(['role:student'])->prefix('student')->name('student.')->group(function () {
        Route::get('/dashboard', [StudentController::class, 'dashboard'])->name('dashboard');
        Route::get('/courses', [StudentController::class, 'courses'])->name('courses');
        Route::post('/courses/{course}/enroll', [StudentController::class, 'enrollCourse'])->name('courses.enroll');
    });
});
