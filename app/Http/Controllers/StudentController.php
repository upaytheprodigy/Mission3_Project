<?php
// app/Http/Controllers/StudentController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use App\Models\Take;

class StudentController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $enrolledCourses = $user->enrolledCourses;
        
        // Hitung GPA
        $totalCredits = 0;
        $totalPoints = 0;
        
        foreach ($enrolledCourses as $course) {
            if ($course->pivot->grade) {
                $totalCredits += $course->credits;
                $totalPoints += $course->pivot->grade * $course->credits;
            }
        }
        
        $gpa = $totalCredits > 0 ? round($totalPoints / $totalCredits, 2) : 0;

        return view('student.dashboard', compact('enrolledCourses', 'gpa'));
    }

    public function courses()
    {
        $user = Auth::user();
        $enrolledCourseIds = $user->enrolledCourses->pluck('id')->toArray();
        $availableCourses = Course::whereNotIn('id', $enrolledCourseIds)
                                 ->with('dosen')
                                 ->get();

        return view('student.courses', compact('availableCourses'));
    }

    public function enrollCourse(Request $request, Course $course)
    {
        $user = Auth::user();
        
        // Cek apakah sudah terdaftar
        if ($user->enrolledCourses()->where('course_id', $course->id)->exists()) {
            return redirect()->back()->with('error', 'Anda sudah terdaftar di course ini');
        }

        Take::create([
            'student_id' => $user->id,
            'course_id' => $course->id,
            'enroll_date' => now(),
        ]);

        return redirect()->route('student.courses')->with('success', 'Berhasil mendaftar course');
    }
}