<?php

namespace App\Http\Controllers\DentalManagement;

use App\Http\Controllers\Controller;
use App\Models\MedicalHistory;
use App\Models\Patient;
use Illuminate\Http\Request;
use App\Services\DentalManagement\MedicalHistoryService;
use App\Http\Requests\DentalManagement\MedicalHistory\StoreRequest;
use App\Http\Requests\DentalManagement\MedicalHistory\UpdateRequest;
use App\Http\Requests\DentalManagement\MedicalHistory\DeleteRequest;

class MedicalHistoryController extends Controller
{
    public function index(Request $request)
    {
        $query = MedicalHistory::with('patient');

        if ($request->filled('patient_id')) {
            $query->where('patient_id', $request->patient_id);
        }

        $sort = $request->get('sort', 'id');
        $direction = $request->get('direction', 'asc');
        if (in_array($sort, ['id']) && in_array($direction, ['asc', 'desc'])) {
            $query->orderBy($sort, $direction);
        }

        $medicalHistories = $query->paginate(10)->appends($request->all());
        $patients = Patient::all();

        return view('dental_management.medical_histories.index', compact('medicalHistories', 'patients'));
    }

    public function create()
    {
        $patients = Patient::all();
        return view('dental_management.medical_histories.create', compact('patients'));
    }

    public function store(StoreRequest $request, MedicalHistoryService $service)
    {
        $data = $request->validated();
        $data['tenant_id'] = auth()->user()->tenant_id ?? session('tenant_id');

        $service->create($data);

        return redirect()
            ->route('dental_management.medical_histories.index')
            ->with('success', __('medical_histories.created_success'));
    }

    public function show(MedicalHistory $medicalHistory)
    {
        return view('dental_management.medical_histories.show', compact('medicalHistory'));
    }

    public function edit(MedicalHistory $medicalHistory)
    {
        $patients = Patient::all();
        return view('dental_management.medical_histories.edit', compact('medicalHistory', 'patients'));
    }

    public function update(UpdateRequest $request, MedicalHistory $medicalHistory, MedicalHistoryService $service)
    {
        $data = $request->validated();
        $data['tenant_id'] = auth()->user()->tenant_id ?? session('tenant_id');

        $service->update($medicalHistory, $data);

        return redirect()
            ->route('dental_management.patients.show', $medicalHistory->patient->slug)
            ->with('success', __('medical_histories.updated_success'));
    }

    public function delete(MedicalHistory $medicalHistory)
    {
        return view('dental_management.medical_histories.delete', compact('medicalHistory'));
    }

    public function deleteSave(DeleteRequest $request, MedicalHistory $medicalHistory, MedicalHistoryService $service)
    {
        $service->delete($medicalHistory, $request->deleted_description);
        return redirect()->route('dental_management.medical_histories.index')->with('success', __('medical_histories.deleted_success'));
    }
}
