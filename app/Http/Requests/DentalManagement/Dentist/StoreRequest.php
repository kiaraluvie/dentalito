<?php

namespace App\Http\Requests\DentalManagement\Dentist;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Assuming permissions will be handled by the controller/middleware
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'specialties' => 'required|array|min:1',
            'specialties.*' => 'integer|exists:specialties,id',
            'license_number' => 'required|string|max:255|unique:dentists',
            'phone' => 'nullable|string|max:20',
        ];
    }
}
