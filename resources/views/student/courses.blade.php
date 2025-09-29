{{-- resources/views/student/courses.blade.php --}}
@extends('layouts.app')

@section('title', 'Available Courses')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h1>Available Courses</h1>
        <p>Pilih course yang ingin Anda ambil:</p>
    </div>
</div>

<div class="row">
    @foreach($availableCourses as $course)
    <div class="col-md-4 mb-3">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $course->course_name }}</h5>
                <p class="card-text">
                    <strong>SKS:</strong> {{ $course->credits }}<br>
                    <strong>Dosen:</strong> {{ $course->dosen->full_name }}<br>
                    @if($course->description)
                        <small class="text-muted">{{ $course->description }}</small>
                    @endif
                </p>
                <form action="{{ route('student.courses.enroll', $course->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary" onclick="return confirm('Yakin ingin mendaftar course ini?')">
                        Enroll Course
                    </button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>

@if($availableCourses->count() == 0)
    <div class="alert alert-info">
        Tidak ada course yang tersedia untuk didaftarkan.
    </div>
@endif
@endsection