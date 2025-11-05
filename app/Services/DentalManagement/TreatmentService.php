<?php

namespace App\Services\DentalManagement;

use App\Models\Treatment;
use Illuminate\Support\Str;

class TreatmentService
{
    public function create(array $data): Treatment
    {
        $treatment = Treatment::create(array_merge($data, [
            'slug' => Str::slug($data['date'] . '-' . $data['patient_id'] . '-' . uniqid()),
            'created_by' => auth()->id(),
        ]));

        return $treatment;
    }

    public function update(Treatment $treatment, array $data): Treatment
    {
        $treatment->update(array_merge($data, [
            'updated_by' => auth()->id(),
        ]));

        return $treatment;
    }

    public function delete(Treatment $treatment, ?string $description): void
    {
        $treatment->deleted_description = $description;
        $treatment->deleted_by = auth()->id();
        $treatment->save();

        $treatment->delete();
    }
}
