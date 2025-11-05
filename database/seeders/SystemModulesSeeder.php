<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SystemModule; // Usar el modelo Eloquent
use Illuminate\Support\Str;

class SystemModulesSeeder extends Seeder
{
    public function run(): void
    {
        $modules = [
            [
                'name' => 'Countries',
                'permission_key' => 'countries',
            ],
            [
                'name' => 'Users',
                'permission_key' => 'users',
            ],
            [
                'name' => 'Companies',
                'permission_key' => 'companies',
            ],
            // Puedes añadir más módulos aquí en el futuro
        ];

        foreach ($modules as $module) {
            SystemModule::firstOrCreate(
                ['permission_key' => $module['permission_key']], // Condición para buscar
                [
                    'name' => $module['name'],
                    'slug' => Str::random(22),
                    'created_by' => 1, // Opcional: ajustar según sea necesario
                ]
            );
        }
    }
}
