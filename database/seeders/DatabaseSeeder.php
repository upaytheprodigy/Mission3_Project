<?php
// database/seeders/DatabaseSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Course;
use App\Models\Take;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Admin (convert dari CI4 users table)
        $admin = User::create([
            'username' => 'admin',
            'password' => 'admin123',
            'full_name' => 'Administrator',
            'role' => 'admin',
        ]);

        // Dosen
        $dosen = User::create([
            'username' => 'dosen1',
            'password' => 'dosen123',
            'full_name' => 'Dr. John Doe',
            'role' => 'dosen',
        ]);

        // Mahasiswa (convert dari CI4 mahasiswa table)
        $mahasiswa = User::create([
            'username' => 'mhs001',
            'password' => 'mhs123',
            'full_name' => 'Budi Santoso',
            'role' => 'mahasiswa',
            'entry_year' => '2021',
        ]);

        // Course
        $course = Course::create([
            'course_name' => 'Pemrograman Web',
            'credits' => 3,
            'dosen_id' => $dosen->id,
        ]);

        // Enrollment
        Take::create([
            'student_id' => $mahasiswa->id,
            'course_id' => $course->id,
            'enroll_date' => now(),
        ]);
    }
}