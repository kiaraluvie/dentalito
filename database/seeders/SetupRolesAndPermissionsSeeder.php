<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class SetupRolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create roles
        $superRole = Role::firstOrCreate(['name' => 'super'], ['description' => 'Super Admin: Full Access']);
        $adminRole = Role::firstOrCreate(['name' => 'admin'], ['description' => 'Tenant Administrator']);
        $userRole  = Role::firstOrCreate(['name' => 'user'], ['description' => 'User with profiles']);
        $langManagerRole = Role::firstOrCreate(['name' => 'language_manager'], ['description' => 'Manages system languages']);
        $dentistRole = Role::firstOrCreate(['name' => 'Dentist'], ['description' => 'Dentist role']);
        $patientRole = Role::firstOrCreate(['name' => 'Patient'], ['description' => 'Patient role']);

        // Delete the old "Super Admin" role if it exists
        $oldSuperAdmin = Role::where('name', 'Super Admin')->first();
        if ($oldSuperAdmin) {
            $oldSuperAdmin->delete();
        }

        // Assign all permissions to super and admin roles
        $allPermissions = Permission::all();
        $superRole->syncPermissions($allPermissions);
        $adminRole->syncPermissions($allPermissions);

        // Assign specific permissions to user role
        $userPermissions = ['users.view', 'countries.view'];
        $userRole->syncPermissions($userPermissions);

        // Assign language permissions to language_manager role
        $languagePermissions = Permission::where('name', 'like', 'languages.%')->get();
        $langManagerRole->syncPermissions($languagePermissions);
    }
}
