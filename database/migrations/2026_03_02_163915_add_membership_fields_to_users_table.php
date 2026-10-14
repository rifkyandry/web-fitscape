<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('member_id')->nullable()->unique()->after('id');
            $table->string('role')->default('member')->after('email');
            $table->string('totp_secret')->nullable()->after('role');
            $table->string('phone')->nullable()->after('totp_secret');
            $table->date('birth_date')->nullable()->after('phone');
            $table->string('membership_status')->default('none')->after('birth_date');
            $table->date('membership_start_date')->nullable()->after('membership_status');
            $table->date('membership_end_date')->nullable()->after('membership_start_date');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'member_id',
                'role', 
                'totp_secret',
                'phone',
                'birth_date',
                'membership_status',
                'membership_start_date',
                'membership_end_date',
            ]);
        });
    }
};