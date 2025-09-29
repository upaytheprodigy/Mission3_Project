@extends('layouts.app')

@section('title', 'Dashboard Dosen')

@section('content')
<div class="container">
    <h1 class="mb-4">Dashboard Dosen</h1>
    <p>Selamat datang, {{ Auth::user()->full_name }}!</p>

    <div class="card">
        <div class="card-header">
            Mata Kuliah yang Anda Ajar
        </div>
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Nama Mata Kuliah</th>
                        <th>Jumlah Mahasiswa</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($courses as $course)
                        <tr>
                            <td>{{ $course->course_name }}</td>
                            <td>{{ $course->students_count }} orang</td>
                            <td>
                                <a href="{{ route('dosen.courses.students', $course->id) }}" class="btn btn-sm btn-info">
                                    Lihat & Input Nilai
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center">Anda belum ditugaskan untuk mengajar mata kuliah apapun.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection