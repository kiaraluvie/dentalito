<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('medical_histories', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->unsignedInteger('patient_id');
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
            $table->text('allergies')->nullable();
            $table->text('chronic_diseases')->nullable();
            $table->text('medications')->nullable();
            $table->text('surgical_history')->nullable();
            $table->text('family_history')->nullable();
            $table->text('observations')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users');
            $table->foreignId('updated_by')->nullable()->constrained('users');
            $table->foreignId('deleted_by')->nullable()->constrained('users');
            $table->string('deleted_description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        // Move data from patients to medical_histories
        $patients = DB::table('patients')->get();
        foreach ($patients as $patient) {
            DB::table('medical_histories')->insert([
                'patient_id' => $patient->id,
                'slug' => Str::slug($patient->name . ' ' . $patient->lastname . '-' . uniqid()),
                'allergies' => $patient->allergies,
                'chronic_diseases' => $patient->chronic_diseases,
                'medications' => $patient->medications,
                'surgical_history' => $patient->surgical_history,
                'family_history' => $patient->family_history,
                'observations' => $patient->observations,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        Schema::table('patients', function (Blueprint $table) {
            $table->dropColumn(['allergies', 'chronic_diseases', 'medications', 'surgical_history', 'family_history', 'observations']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('patients', function (Blueprint $table) {
            $table->text('allergies')->nullable();
            $table->text('chronic_diseases')->nullable();
            $table->text('medications')->nullable();
            $table->text('surgical_history')->nullable();
            $table->text('family_history')->nullable();
            $table->text('observations')->nullable();
        });

        // Move data back from medical_histories to patients
        $medicalHistories = DB::table('medical_histories')->get();
        foreach ($medicalHistories as $history) {
            DB::table('patients')->where('id', $history->patient_id)->update([
                'allergies' => $history->allergies,
                'chronic_diseases' => $history->chronic_diseases,
                'medications' => $history->medications,
                'surgical_history' => $history->surgical_history,
                'family_history' => $history->family_history,
                'observations' => $history->observations,
            ]);
        }

        Schema::dropIfExists('medical_histories');
    }
};
