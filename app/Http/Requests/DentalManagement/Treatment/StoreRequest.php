<?php

namespace App\Http\Requests\DentalManagement\Treatment;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'patient_id' => 'required|exists:patients,id',
            'dentist_id' => 'required|exists:dentists,id',
            'procedure_id' => 'required|exists:procedures,id',
            'description' => 'nullable|string',
            'date' => 'required|date',
            'price' => 'required|numeric|min:0',
            'status' => 'required|in:pending,in_progress,completed,cancelled',
        ];
    }
}