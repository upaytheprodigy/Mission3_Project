<?php
// app/Models/Take.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Take extends Model
{
    protected $fillable = ['student_id', 'course_id', 'enroll_date', 'grade'];
    
    protected $casts = [
        'enroll_date' => 'date',
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}