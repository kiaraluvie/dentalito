<?php

namespace App\Http\Controllers\DentalManagement;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\Odontogram;
use App\Http\Requests\DentalManagement\OdontogramRequest;
use Illuminate\Support\Facades\Log;

class OdontogramController extends Controller
{
    /**
     * Muestra el odontograma más reciente de un paciente.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Patient $patient)
    {
        Log::info("Buscando odontograma para el paciente: {$patient->id}");

        $odontogram = $patient->odontograms()->latest('odontogram_date')->first();

        return response()->json([
            'patient' => $patient,
            'odontogram' => $odontogram
        ]);
    }

    /**
     * Guarda un nuevo odontograma para un paciente.
     *
     * @param  \App\Http\Requests\DentalManagement\OdontogramRequest  $request
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(OdontogramRequest $request, Patient $patient)
    {
        Log::info("Guardando nuevo odontograma para el paciente: {$patient->id}");

        $odontogram = $patient->odontograms()->create($request->validated());

        return response()->json([
            'message' => 'Odontograma guardado con éxito.',
            'odontogram' => $odontogram
        ], 201);
    }

    /**
     * Actualiza un odontograma existente.
     *
     * @param  \App\Http\Requests\DentalManagement\OdontogramRequest  $request
     * @param  \App\Models\Patient  $patient
     * @param  \App\Models\Odontogram  $odontogram
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(OdontogramRequest $request, Patient $patient, Odontogram $odontogram)
    {
        Log::info("Actualizando odontograma {$odontogram->id} para el paciente: {$patient->id}");

        // Asegurarse de que el odontograma pertenece al paciente correcto por seguridad.
        if ($odontogram->patient_id !== $patient->id) {
            return response()->json(['message' => 'No autorizado.'], 403);
        }

        $odontogram->update($request->validated());

        return response()->json([
            'message' => 'Odontograma actualizado con éxito.',
            'odontogram' => $odontogram
        ]);
    }
}
