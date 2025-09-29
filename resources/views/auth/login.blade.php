{{-- resources/views/auth/login.blade.php --}}
@extends('layouts.app')

@section('title', 'Login - JTK Polban')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">Login JTK Polban</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" id="username" class="form-control" required autofocus>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                </form>
                
                <hr>
                <small class="text-muted">
                    <strong>Demo Login:</strong><br>
                    Admin: admin/admin123<br>
                    Dosen: dosen1/dosen123<br>
                    Student: student1/student123
                </small>
            </div>
        </div>
    </div>
</div>
@endsection