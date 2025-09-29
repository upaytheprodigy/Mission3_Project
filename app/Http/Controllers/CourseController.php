<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\User;

class CourseController extends Controller
{
    /**
     * Display a listing of courses.
     */
    public function index()
    {
        $courses = Course::with('dosen')->get();
        $dosens = User::where('role', 'dosen')->get();
        
        return view('admin.courses.index', compact('courses', 'dosens'));
    }

    /**
     * Show the form for creating a new course.
     */
    public function create()
    {
        $dosens = User::where('role', 'dosen')->get();
        
        return view('admin.courses.create', compact('dosens'));
    }

    /**
     * Store a newly created course in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'course_name' => 'required|string|max:255',
            'credits' => 'required|integer|min:1|max:6',
            'dosen_id' => 'required|exists:users,id',
            'description' => 'nullable|string|max:1000',
        ]);

        // Verifikasi bahwa dosen_id adalah user dengan role dosen
        $dosen = User::where('id', $request->dosen_id)
                    ->where('role', 'dosen')
                    ->first();
                    
        if (!$dosen) {
            return redirect()->back()
                           ->withInput()
                           ->with('error', 'Selected user is not a valid dosen');
        }

        Course::create([
            'course_name' => $request->course_name,
            'credits' => $request->credits,
            'dosen_id' => $request->dosen_id,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.courses.index')
                        ->with('success', 'Course berhasil ditambahkan');
    }

    /**
     * Display the specified course.
     */
    public function show(Course $course)
    {
        $course->load(['dosen', 'students']);
        
        return view('admin.courses.show', compact('course'));
    }

    /**
     * Show the form for editing the specified course.
     */
    public function edit(Course $course)
    {
        $dosens = User::where('role', 'dosen')->get();
        
        return view('admin.courses.edit', compact('course', 'dosens'));
    }

    /**
     * Update the specified course in storage.
     */
    public function update(Request $request, Course $course)
    {
        $request->validate([
            'course_name' => 'required|string|max:255',
            'credits' => 'required|integer|min:1|max:6',
            'dosen_id' => 'required|exists:users,id',
            'description' => 'nullable|string|max:1000',
        ]);

        // Verifikasi bahwa dosen_id adalah user dengan role dosen
        $dosen = User::where('id', $request->dosen_id)
                    ->where('role', 'dosen')
                    ->first();
                    
        if (!$dosen) {
            return redirect()->back()
                           ->withInput()
                           ->with('error', 'Selected user is not a valid dosen');
        }

        $course->update([
            'course_name' => $request->course_name,
            'credits' => $request->credits,
            'dosen_id' => $request->dosen_id,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.courses.index')
                        ->with('success', 'Course berhasil diupdate');
    }

    /**
     * Remove the specified course from storage.
     */
    public function destroy(Course $course)
    {
        // Cek apakah ada student yang terdaftar di course ini
        if ($course->students()->count() > 0) {
            return redirect()->route('admin.courses.index')
                           ->with('error', 'Cannot delete course with enrolled students');
        }

        $courseName = $course->course_name;
        $course->delete();

        return redirect()->route('admin.courses.index')
                        ->with('success', "Course '{$courseName}' berhasil dihapus");
    }

    /**
     * Get courses data for API/AJAX calls
     */
    public function getCourses()
    {
        $courses = Course::with('dosen:id,full_name')
                        ->select('id', 'course_name', 'credits', 'dosen_id')
                        ->get();

        return response()->json($courses);
    }

    /**
     * Get students enrolled in a specific course
     */
    public function getStudents(Course $course)
    {
        $students = $course->students()
                          ->select('users.id', 'users.username', 'users.full_name', 'takes.grade', 'takes.enroll_date')
                          ->get();

        return response()->json($students);
    }
}