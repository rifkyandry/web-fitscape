<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::dropIfExists('presences'); // tambahkan ini
        Schema::create('presences', function (Blueprint $table) {
            $table->id();
            // Tambahkan baris di bawah ini untuk menghubungkan absensi dengan member
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         Schema::disableForeignKeyConstraints(); // tambahkan ini
        Schema::dropIfExists('presences');
         Schema::enableForeignKeyConstraints(); // tambahkan ini
    }
};