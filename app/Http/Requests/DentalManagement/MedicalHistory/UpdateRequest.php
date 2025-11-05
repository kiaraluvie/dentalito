<?php

namespace App\Http\Requests\DentalManagement\MedicalHistory;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'patient_id' => 'required|exists:patients,id|unique:medical_histories,patient_id,' . $this->medical_history->id,
            'allergies' => 'nullable|string',
            'chronic_diseases' => 'nullable|string',
            'medications' => 'nullable|string',
            'surgical_history' => 'nullable|string',
            'family_history' => 'nullable|string',
            'observations' => 'nullable|string',
        ];
    }
}