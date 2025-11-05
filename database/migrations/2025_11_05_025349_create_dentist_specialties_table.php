<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dentist_specialties', function (Blueprint $table) {
            $table->id();

            $table->foreignId('dentist_id')->constrained('dentists')->onDelete('cascade');
            $table->foreignId('specialty_id')->constrained('specialties')->onDelete('cascade');

            $table->timestamps();

            // To prevent duplicate entries
            $table->unique(['dentist_id', 'specialty_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dentist_specialties');
    }
};
