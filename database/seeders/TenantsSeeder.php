<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tenant; // Usar el modelo Eloquent
use Illuminate\Support\Str;

class TenantsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tenants = [
            ['name' => 'HITACHI ENERGY'],
            ['name' => 'SIEMBRES'],
        ];

        foreach ($tenants as $tenant) {
            Tenant::firstOrCreate(
                ['name' => $tenant['name']], // Condición para buscar
                [
                    'slug' => Str::random(22),
                    'created_by' => 1, // Opcional: ajustar según sea necesario
                ]
            );
        }
    }
}
