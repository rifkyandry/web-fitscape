<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('pending_package_id')->nullable()->after('membership_package_id');
            $table->integer('pending_duration_months')->nullable()->after('pending_package_id');
            $table->foreign('pending_package_id')->references('id')->on('membership_packages')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['pending_package_id']);
            $table->dropColumn(['pending_package_id', 'pending_duration_months']);
        });
    }
};