@extends('layouts.app')

@section('title', 'Course List - Admin')

@section('content')
<div class="container">
    <h1 class="mb-3">Course List</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="mb-3">
        <a href="{{ route('admin.courses.create') }}" class="btn btn-primary">
            + Add Course
        </a>
    </div>

    <div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th style="width:50px">#</th>
                <th>Course Name</th>
                <th>Description</th>
                <th style="width:180px">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($courses as $course)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $course->course_name }}</td>
                    <td>{{ $course->description ?? '-' }}</td>
                    <td>
                        <a href="{{ route('admin.courses.edit', $course->id) }}" class="btn btn-sm btn-warning">Edit</a>

                        <form action="{{ route('admin.courses.destroy', $course->id) }}" 
                              method="POST" 
                              style="display:inline-block"
                              onsubmit="return confirm('Are you sure you want to delete this course?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">No courses found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    </div>
</div>
@endsection
