<?php
// app/Http/Controllers/DashboardController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Course;
use App\Models\Take;

class DashboardController extends Controller
{
    // Convert dari HomeController::index() dengan role-based redirect
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        // Role-based dashboard (upgrade dari CI4 session)
        if ($user->isAdmin()) {
            return $this->adminDashboard();
        } elseif ($user->isDosen()) {
            return $this->dosenDashboard();
        } else {
            return $this->mahasiswaDashboard();
        }
    }

    private function adminDashboard()
    {
        $users = User::all();
        $courses = Course::with('dosen')->get();
        $dosens = User::where('role', 'dosen')->get();
        
        return view('admin.dashboard', compact('users', 'courses', 'dosens'));
    }

    private function dosenDashboard()
    {
        $user = Auth::user();
        $courses = $user->coursesAsDosen;
        $enrollments = Take::whereHas('course', function($q) use ($user) {
            $q->where('dosen_id', $user->id);
        })->with(['student', 'course'])->get();

        return view('dosen.dashboard', compact('courses', 'enrollments'));
    }

    private function mahasiswaDashboard()
    {
        $user = Auth::user();
        $enrollments = $user->coursesAsStudent;
        
        return view('mahasiswa.dashboard', compact('enrollments'));
    }
}