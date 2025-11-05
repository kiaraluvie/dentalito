<?php

namespace App\Http\Requests\DentalManagement\Appointment;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'patient_id' => 'required|exists:patients,id',
            'dentist_id' => 'required|exists:dentists,id',
            'appointment_date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'reason' => 'nullable|string',
            'status' => 'required|string|in:Scheduled,Completed,Canceled,No Show',
            'notes' => 'nullable|string',
            'is_active' => 'required|boolean',
        ];
    }
}
