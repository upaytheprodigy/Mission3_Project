@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Course</h1>

    {{-- tampilkan error validasi --}}
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- form tambah course --}}
    <form action="{{ route('admin.courses.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="course_name" class="form-label">Nama Course</label>
            <input type="text" name="course_name" id="course_name" 
                   class="form-control" value="{{ old('course_name') }}" required>
        </div>

        <div class="mb-3">
            <label for="credits" class="form-label">Jumlah SKS</label>
            <input type="number" name="credits" id="credits" 
                   class="form-control" value="{{ old('credits') }}" min="1" max="6" required>
        </div>

        <div class="mb-3">
            <label for="dosen_id" class="form-label">Dosen Pengampu</label>
            <select name="dosen_id" id="dosen_id" class="form-select" required>
                <option value="">-- Pilih Dosen --</option>
                @foreach($dosens as $dosen)
                    <option value="{{ $dosen->id }}" {{ old('dosen_id') == $dosen->id ? 'selected' : '' }}>
                        {{ $dosen->full_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea name="description" id="description" rows="3" class="form-control">{{ old('description') }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('admin.courses.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
