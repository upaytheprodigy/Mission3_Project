@extends('layouts.app')

@section('title', 'Course Students')

@section('content')
<div class="container">
    <h1>Students in {{ $course->course_name }}</h1>
    
    <div class="card">
        <div class="card-header">
            <h5>Input Grades</h5>
        </div>
        <div class="card-body">
            @if($enrollments->count() > 0)
                <table class="table">
                    <thead>
                        <tr>
                            <th>Student Name</th>
                            <th>Username</th>
                            <th>Enroll Date</th>
                            <th>Current Grade</th>
                            <th>Update Grade</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($enrollments as $enrollment)
                        <tr>
                            <td>{{ $enrollment->student->full_name }}</td>
                            <td>{{ $enrollment->student->username }}</td>
                            <td>{{ $enrollment->enroll_date->format('d/m/Y') }}</td>
                            <td>
                                @if($enrollment->grade)
                                    <span class="badge bg-success">{{ $enrollment->grade }}</span>
                                @else
                                    <span class="badge bg-warning">No Grade</span>
                                @endif
                            </td>
                            <td>
                                <form action="{{ route('dosen.grades.update', $enrollment->id) }}" method="POST" class="d-flex">
                                    @csrf
                                    @method('PUT')
                                    <input type="number" name="grade" value="{{ $enrollment->grade }}" 
                                           step="0.01" min="0" max="4" class="form-control me-2" style="width: 80px;">
                                    <button type="submit" class="btn btn-sm btn-primary">Update</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="alert alert-info">
                    No students enrolled in this course.
                </div>
            @endif
        </div>
    </div>
    
    <div class="mt-3">
        <a href="{{ route('dosen.dashboard') }}" class="btn btn-secondary">Back to Dashboard</a>
    </div>
</div>
@endsection