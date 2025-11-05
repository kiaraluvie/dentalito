<?php

namespace App\Services\DentalManagement;

use App\Models\Patient;
use Illuminate\Support\Str;

class PatientService
{
    public function create(array $data): Patient
    {
        $patient = Patient::create(array_merge($data, [
            'slug' => Str::slug($data['name'] . ' ' . $data['lastname'] . '-' . uniqid()),
            'created_by' => auth()->id(),
        ]));

        return $patient;
    }

    public function update(Patient $patient, array $data): Patient
    {
        $patient->update(array_merge($data, [
            'updated_by' => auth()->id(),
        ]));

        return $patient;
    }

    public function delete(Patient $patient, ?string $description): void
    {
        $patient->deleted_description = $description;
        $patient->deleted_by = auth()->id();
        $patient->save();

        $patient->delete();
    }
}
