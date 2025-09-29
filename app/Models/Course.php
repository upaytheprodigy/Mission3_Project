<?php
// app/Models/Course.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = ['course_name', 'credits', 'dosen_id', 'description'];

    public function dosen()
    {
        return $this->belongsTo(User::class, 'dosen_id');
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'takes', 'course_id', 'student_id')
                    ->withPivot('enroll_date', 'grade', 'id')
                    ->withTimestamps();
    }

    public function takes()
    {
        return $this->hasMany(Take::class);
    }
}