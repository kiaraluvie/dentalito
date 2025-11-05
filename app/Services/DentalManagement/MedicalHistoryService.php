<?php

namespace App\Services\DentalManagement;

use App\Models\MedicalHistory;
use Illuminate\Support\Str;

class MedicalHistoryService
{
    public function create(array $data): MedicalHistory
    {
        $medicalHistory = MedicalHistory::create(array_merge($data, [
            'slug' => Str::slug($data['patient_id'] . '-' . uniqid()),
            'created_by' => auth()->id(),
        ]));

        return $medicalHistory;
    }

    public function update(MedicalHistory $medicalHistory, array $data): MedicalHistory
    {
        $medicalHistory->update(array_merge($data, [
            'updated_by' => auth()->id(),
        ]));

        return $medicalHistory;
    }

    public function delete(MedicalHistory $medicalHistory, ?string $description): void
    {
        $medicalHistory->deleted_description = $description;
        $medicalHistory->deleted_by = auth()->id();
        $medicalHistory->save();

        $medicalHistory->delete();
    }
}
