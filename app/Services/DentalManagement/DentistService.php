<?php

namespace App\Services\DentalManagement;

use App\Models\User;
use App\Models\Dentist;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DentistService
{
    public function create(array $data): Dentist
    {
        // 1. Crear el usuario asociado
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'tenant_id' => auth()->user()->tenant_id,
            'country_id' => auth()->user()->country_id,
            'locale_id' => auth()->user()->locale_id,
        ]);

        // 2. Asignar rol de dentista
        $user->assignRole('Dentist');

        // 3. Crear el perfil del dentista
        $dentist = Dentist::create([
            'user_id' => $user->id,
            'license_number' => $data['license_number'],
            'phone' => $data['phone'],
            'is_active' => $data['is_active'] ?? true,
            'slug' => Str::slug($user->name . '-' . uniqid()),
            'created_by' => auth()->id(),
        ]);

        // 4. Asignar especialidades (relación many-to-many)
        if (!empty($data['specialties'])) {
            $dentist->specialties()->sync($data['specialties']);
        }

        return $dentist;
    }

    public function update(Dentist $dentist, array $data): Dentist
    {
        // 1. Actualizar el usuario asociado
        $dentist->user->update([
            'name' => $data['name'],
            'email' => $data['email'],
        ]);

        // 2. Actualizar contraseña si se proporciona
        if (!empty($data['password'])) {
            $dentist->user->update([
                'password' => Hash::make($data['password']),
            ]);
        }

        // 3. Actualizar los datos del perfil del dentista
        $dentist->update([
            'license_number' => $data['license_number'],
            'phone' => $data['phone'],
            'is_active' => $data['is_active'] ?? $dentist->is_active,
            'updated_by' => auth()->id(),
        ]);

        // 4. Actualizar las especialidades
        if (isset($data['specialties'])) {
            $dentist->specialties()->sync($data['specialties']);
        }

        return $dentist;
    }

    public function delete(Dentist $dentist, ?string $description): void
    {
        // 1. Guardar descripción de eliminación y usuario
        $dentist->deleted_description = $description;
        $dentist->deleted_by = auth()->id();
        $dentist->save();

        // 2. Soft delete del dentista
        $dentist->delete();

        // 3. Desactivar el usuario asociado
        $dentist->user->update(['is_active' => false]);
    }
}
