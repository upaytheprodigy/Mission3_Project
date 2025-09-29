<?php
// app/Http/Controllers/DosenController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Take;
use Illuminate\Support\Facades\Auth;

class DosenController extends Controller
{
    public function dashboard()
    {
        $dosen = Auth::user();

        $courses = Course::where('dosen_id', $dosen->id)
                        ->withCount('students') 
                        ->get();

        return view('dosen.dashboard', compact('courses'));
    }

    public function courseStudents($courseId)
    {
        $user = Auth::user();
        $course = $user->coursesAsDosen()->findOrFail($courseId);
        $enrollments = Take::where('course_id', $courseId)
                          ->with('student')
                          ->get();

        return view('dosen.student', compact('course', 'enrollments'));
    }

    public function updateGrade(Request $request, Take $take)
    {
        // Pastikan dosen hanya bisa update grade untuk course miliknya
        if ($take->course->dosen_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'grade' => 'required|numeric|min:0|max:4',
        ]);

        $take->update(['grade' => $request->grade]);

        return redirect()->back()->with('success', 'Nilai berhasil diupdate');
    }
}