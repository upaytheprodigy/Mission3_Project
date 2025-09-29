{{-- resources/views/student/dashboard.blade.php --}}
@extends('layouts.app')

@section('title', 'Student Dashboard')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h1>Dashboard Student</h1>
        <p>Selamat datang, {{ Auth::user()->full_name }}!</p>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card text-white bg-info">
            <div class="card-body">
                <h5 class="card-title">Enrolled Courses</h5>
                <h2>{{ $enrolledCourses->count() }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-white bg-success">
            <div class="card-body">
                <h5 class="card-title">GPA</h5>
                <h2>{{ $gpa }}</h2>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>My Courses & Grades</h5>
            </div>
            <div class="card-body">
                @if($enrolledCourses->count() > 0)
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Course Name</th>
                                <th>Credits</th>
                                <th>Dosen</th>
                                <th>Enroll Date</th>
                                <th>Grade</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($enrolledCourses as $course)
                            <tr>
                                <td>{{ $course->course_name }}</td>
                                <td>{{ $course->credits }}</td>
                                <td>{{ $course->dosen->full_name }}</td>
                                <td>{{ $course->pivot->enroll_date->format('d/m/Y') }}</td>
                                <td>
                                    @if($course->pivot->grade)
                                        <span class="badge bg-success">{{ $course->pivot->grade }}</span>
                                    @else
                                        <span class="badge bg-warning">Belum ada nilai</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>Anda belum mendaftar di course manapun. <a href="{{ route('student.courses') }}">Lihat available courses</a></p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection