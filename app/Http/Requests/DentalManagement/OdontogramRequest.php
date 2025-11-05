<?php

namespace App\Http\Requests\DentalManagement;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class OdontogramRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [
            'odontogram_date' => 'required|date',
            'data_json' => [
                'required',
                'json',
                function ($attribute, $value, $fail) {
                    $data = json_decode($value, true);
                    if (!is_array($data)) {
                        $fail('El campo ' . $attribute . ' debe ser un JSON válido.');
                        return;
                    }
                },
            ],
        ];

        // Si el método es PATCH o PUT, las reglas son opcionales.
        if ($this->isMethod('patch') || $this->isMethod('put')) {
            $rules['odontogram_date'] = 'sometimes|' . $rules['odontogram_date'];
            $rules['data_json'][0] = 'sometimes';
        }

        return $rules;
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages()
    {
        return [
            'odontogram_date.required' => 'La fecha del odontograma es obligatoria.',
            'odontogram_date.date' => 'La fecha del odontograma debe ser una fecha válida.',
            'data_json.required' => 'Los datos del odontograma son obligatorios.',
            'data_json.json' => 'El formato de los datos del odontograma no es válido.',
        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Http\Exceptions\HttpResponseException
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors()
        ], 422));
    }
}
