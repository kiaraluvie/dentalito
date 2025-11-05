<?php

namespace App\Services\DentalManagement;

use App\Models\Appointment;
use Illuminate\Support\Str;

class AppointmentService
{
    public function create(array $data): Appointment
    {
        $appointment = Appointment::create(array_merge($data, [
            'slug' => Str::slug($data['reason'] . '-' . uniqid()),
            'created_by' => auth()->id(),
        ]));

        return $appointment;
    }

    public function update(Appointment $appointment, array $data): Appointment
    {
        $appointment->update(array_merge($data, [
            'updated_by' => auth()->id(),
        ]));

        return $appointment;
    }

    public function delete(Appointment $appointment, ?string $description): void
    {
        $appointment->deleted_description = $description;
        $appointment->deleted_by = auth()->id();
        $appointment->save();

        $appointment->delete();
    }
}
