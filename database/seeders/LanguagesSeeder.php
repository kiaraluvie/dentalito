<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Language; // Usar el modelo Eloquent
use Illuminate\Support\Str;

class LanguagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $languages = [
            ['iso_code' => 'es', 'name' => 'Spanish'],
            ['iso_code' => 'en', 'name' => 'English'],
            ['iso_code' => 'pt', 'name' => 'Português'],
            ['iso_code' => 'fr', 'name' => 'French'],
        ];

        foreach ($languages as $language) {
            Language::firstOrCreate(
                ['iso_code' => $language['iso_code']], // Condición para buscar
                [
                    'name' => $language['name'],
                    'slug' => Str::random(22),
                    'created_by' => 1, // Opcional: ajustar según sea necesario
                ]
            );
        }
    }
}