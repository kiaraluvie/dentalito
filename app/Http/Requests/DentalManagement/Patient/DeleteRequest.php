<?php

namespace App\Http\Requests\DentalManagement\Patient;

use Illuminate\Foundation\Http\FormRequest;

class DeleteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'deleted_description' => 'nullable|string|max:255',
        ];
    }
}
