<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class Role_Extra_Seeder extends Seeder
{
    public function run(): void
    {
        Role::firstOrCreate(
            ['name' => 'Dentist', 'guard_name' => 'web'],
            ['description' => 'Role for dental professionals']
        );

        Role::firstOrCreate(
            ['name' => 'Patient', 'guard_name' => 'web'],
            ['description' => 'Role for patients in the system']
        );
    }
}
