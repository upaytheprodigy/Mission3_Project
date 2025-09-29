<?php
// app/Models/User.php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'username', 'password', 'full_name', 'role', 'entry_year', 'email'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    // Role helpers
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isDosen()
    {
        return $this->role === 'dosen';
    }

    public function isStudent()
    {
        return $this->role === 'student';
    }

    // Relationships
    public function coursesAsDosen()
    {
        return $this->hasMany(Course::class, 'dosen_id');
    }

    public function enrolledCourses()
    {
        return $this->belongsToMany(Course::class, 'takes', 'student_id', 'course_id')
                    ->withPivot('enroll_date', 'grade', 'id')
                    ->withTimestamps();
    }

    public function takes()
    {
        return $this->hasMany(Take::class, 'student_id');
    }
}