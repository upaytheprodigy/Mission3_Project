<?php
// database/migrations/xxxx_update_users_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'full_name')) {
                $table->string('full_name')->after('username');
            }
            if (!Schema::hasColumn('users', 'role')) {
                $table->enum('role', ['admin', 'dosen', 'student'])->default('student')->after('password');
            }
            if (!Schema::hasColumn('users', 'entry_year')) {
                $table->string('entry_year')->nullable()->after('role');
            }
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['full_name', 'role', 'entry_year']);
        });
    }
};