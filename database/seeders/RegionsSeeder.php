<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Region; // Usar el modelo Eloquent
use Illuminate\Support\Str;

class RegionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $regions = [
            ['name' => 'América del Sur'],
            ['name' => 'América del Norte'],
            ['name' => 'Europa'],
        ];

        foreach ($regions as $region) {
            Region::firstOrCreate(
                ['name' => $region['name']], // Condición para buscar
                [
                    'slug' => Str::random(22),
                    'created_by' => 1, // Opcional: ajustar según sea necesario
                ]
            );
        }
    }
}
