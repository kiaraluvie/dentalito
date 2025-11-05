<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Patient;
use App\Models\MedicalHistory;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class MedicalHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $patients = Patient::all();

        foreach ($patients as $patient) {
            MedicalHistory::create([
                'patient_id' => $patient->id,
                'slug' => Str::slug($patient->name . ' ' . $patient->lastname . '-' . uniqid()),
                'allergies' => $faker->optional()->sentence,
                'chronic_diseases' => $faker->optional()->sentence,
                'medications' => $faker->optional()->sentence,
                'surgical_history' => $faker->optional()->sentence,
                'family_history' => $faker->optional()->sentence,
                'observations' => $faker->optional()->paragraph,
            ]);
        }
    }
}
