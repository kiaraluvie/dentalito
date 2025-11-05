<?php

namespace App\Http\Requests\DentalManagement\Patient;

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
            'name' => 'required|string|max:100',
            'lastname' => 'required|string|max:100',
            'email' => 'required|email|unique:patients,email',
            'dni' => 'required|string|max:15|unique:patients,dni',
            'sex' => 'required|in:M,F,Other',
            'locale_id' => 'required|exists:locales,id',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'occupation' => 'nullable|string|max:100',
            'marital_status' => 'nullable|in:Single,Married,Divorced,Widowed,Civil Union',
            'blood_type' => 'nullable|string|max:5',
            'emergency_contact_name' => 'nullable|string|max:100',
            'emergency_contact_phone' => 'nullable|string|max:20',
            'allergies' => 'nullable|string',
            'chronic_diseases' => 'nullable|string',
            'medications' => 'nullable|string',
            'surgical_history' => 'nullable|string',
            'family_history' => 'nullable|string',
            'observations' => 'nullable|string',
        ];
    }
}
