<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('membership_packages', function (Blueprint $table) {
            $table->id();
            $table->string('name');                      // Bronze, Silver, Gold
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);             // Harga paket
            $table->integer('duration_days');            // Durasi dalam hari
            $table->string('color')->default('#6B7280'); // Warna badge UI
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('membership_packages');
    }
};