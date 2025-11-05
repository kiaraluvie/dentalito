<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Patient;
use App\Models\Tenant;
use App\Models\Locale;
use Faker\Factory as Faker;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Ensure there's at least one tenant and locale
        $tenant = Tenant::first();
        $locale = Locale::first();

        if (!$tenant) {
            // Handle case where no tenant exists (e.g., create one or throw error)
            $this->command->info('No tenant found. Please seed tenants first.');
            return;
        }

        if (!$locale) {
            // Handle case where no locale exists
            $this->command->info('No locale found. Please seed locales first.');
            return;
        }

        for ($i = 0; $i < 10; $i++) {
            Patient::create([
                'tenant_id' => $tenant->id,
                'name' => $faker->firstName,
                'lastname' => $faker->lastName,
                'dni' => $faker->unique()->numerify('##########'),
                'sex' => $faker->randomElement(['M', 'F', 'Other']),
                'birth_date' => $faker->date('Y-m-d', '2000-01-01'),
                'age' => $faker->numberBetween(18, 80),
                'phone' => $faker->phoneNumber,
                'email' => $faker->unique()->safeEmail,
                'address' => $faker->address,
                'occupation' => $faker->jobTitle,
                'marital_status' => $faker->randomElement(['Single', 'Married', 'Divorced', 'Widowed', 'Civil Union']),
                'blood_type' => $faker->randomElement(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-']),
                'emergency_contact_name' => $faker->name,
                'emergency_contact_phone' => $faker->phoneNumber,
                'locale_id' => $locale->id,
            ]);
        }
    }
}
