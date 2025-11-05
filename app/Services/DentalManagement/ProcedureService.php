<?php

namespace App\Services\DentalManagement;

use App\Models\Procedure;
use Illuminate\Support\Str;

class ProcedureService
{
    public function create(array $data): Procedure
    {
        $procedure = Procedure::create(array_merge($data, [
            'slug' => Str::slug($data['name'] . '-' . uniqid()),
            'created_by' => auth()->id(),
        ]));

        return $procedure;
    }

    public function update(Procedure $procedure, array $data): Procedure
    {
        $procedure->update(array_merge($data, [
            'updated_by' => auth()->id(),
        ]));

        return $procedure;
    }

    public function delete(Procedure $procedure, ?string $description): void
    {
        $procedure->deleted_description = $description;
        $procedure->deleted_by = auth()->id();
        $procedure->save();

        $procedure->delete();
    }
}
