<?php
// app/Http/Controllers/AdminController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Course;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalUsers = User::count();
        $totalCourses = Course::count();
        $totalStudents = User::where('role', 'student')->count();
        $totalDosens = User::where('role', 'dosen')->count();
        $dosens = User::where('role', 'dosen')->get();
        $users = User::latest()->take(5)->get(); // Contoh: Mengambil 5 user terbaru

        return view('admin.dashboard', compact('totalUsers', 'totalCourses', 'totalStudents', 'totalDosens', 'dosens', 'users'));
    }

    // Student Management
    public function students()
    {
        $students = User::where('role', 'student')->get();
        return view('admin.student.index', compact('students'));
    }

    public function createStudent()
    {
        return view('admin.student.create');
    }

    public function storeStudent(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users',
            'full_name' => 'required',
            'password' => 'required|min:6',
            'entry_year' => 'required',
            'email' => 'required|email|unique:users',
        ]);

        User::create([
            'username' => $request->username,
            'full_name' => $request->full_name,
            'password' => $request->password, // Dalam production harus di-hash
            'role' => 'student',
            'entry_year' => $request->entry_year,
            'email' => $request->email,
        ]);

        return redirect()->route('admin.students')->with('success', 'Student berhasil ditambahkan');
    }

    public function editStudent(User $student)
    {
        return view('admin.students.edit', compact('student'));
    }

    public function updateStudent(Request $request, User $student)
    {
        $request->validate([
            'username' => 'required|unique:users,username,' . $student->id,
            'full_name' => 'required',
            'entry_year' => 'required',
            'email' => 'required|email|unique:users,email,' . $student->id,
        ]);

        $updateData = $request->only(['username', 'full_name', 'entry_year', 'email']);
        
        if ($request->filled('password')) {
            $updateData['password'] = $request->password;
        }

        $student->update($updateData);

        return redirect()->route('admin.students')->with('success', 'Student berhasil diupdate');
    }

    public function deleteStudent(User $student)
    {
        $student->delete();
        return redirect()->route('admin.students')->with('success', 'Student berhasil dihapus');
    }

    // Course Management
    public function courses()
    {
        $courses = Course::all();
        return view('admin.courses.index', compact('courses'));
    }


    public function storeCourse(Request $request)
    {
        $request->validate([
            'course_name' => 'required',
            'credits' => 'required|integer|min:1|max:6',
            'dosen_id' => 'required|exists:users,id',
            'description' => 'nullable',
        ]);

        Course::create($request->all());

        return redirect()->route('admin.courses')->with('success', 'Course berhasil ditambahkan');
    }

    public function updateCourse(Request $request, Course $course)
    {
        $request->validate([
            'course_name' => 'required',
            'credits' => 'required|integer|min:1|max:6',
            'dosen_id' => 'required|exists:users,id',
            'description' => 'nullable',
        ]);

        $course->update($request->all());

        return redirect()->route('admin.courses')->with('success', 'Course berhasil diupdate');
    }

    public function deleteCourse(Course $course)
    {
        $course->delete();
        return redirect()->route('admin.courses')->with('success', 'Course berhasil dihapus');
    }
}