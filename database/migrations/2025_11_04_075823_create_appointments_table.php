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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            
            // Use unsignedInteger for patient_id to match the increments() type in patients table
            $table->unsignedInteger('patient_id');
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');

            // foreignId is correct for dentist_id as dentists table uses id()
            $table->foreignId('dentist_id')->constrained()->onDelete('cascade');

            $table->date('appointment_date');
            $table->time('start_time');
            $table->time('end_time');
            $table->text('reason')->nullable();
            $table->string('status')->default('Scheduled'); // e.g., Scheduled, Completed, Canceled, No Show
            $table->text('notes')->nullable();
            $table->boolean('is_active')->default(true);
            $table->string('slug')->unique();
            $table->timestamps();
            $table->softDeletes();

            // Audit fields
            $table->foreignId('created_by')->nullable()->constrained('users');
            $table->foreignId('updated_by')->nullable()->constrained('users');
            $table->foreignId('deleted_by')->nullable()->constrained('users');
            $table->text('deleted_description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
