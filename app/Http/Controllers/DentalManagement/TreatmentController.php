<?php

namespace App\Http\Controllers\DentalManagement;

use App\Http\Controllers\Controller;
use App\Models\Treatment;
use App\Models\Patient;
use App\Models\Dentist;
use App\Models\Procedure;
use Illuminate\Http\Request;
use App\Services\DentalManagement\TreatmentService;
use App\Http\Requests\DentalManagement\Treatment\StoreRequest;
use App\Http\Requests\DentalManagement\Treatment\UpdateRequest;
use App\Http\Requests\DentalManagement\Treatment\DeleteRequest;

class TreatmentController extends Controller
{
    public function index(Request $request)
    {
        $query = Treatment::with(['patient', 'dentist', 'procedure']);

        if ($request->filled('patient_id')) {
            $query->where('patient_id', $request->patient_id);
        }

        if ($request->filled('dentist_id')) {
            $query->where('dentist_id', $request->dentist_id);
        }

        if ($request->filled('procedure_id')) {
            $query->where('procedure_id', $request->procedure_id);
        }

        if ($request->filled('date')) {
            $query->whereDate('date', $request->date);
        }

        $sort = $request->get('sort', 'id');
        $direction = $request->get('direction', 'asc');
        if (in_array($sort, ['id', 'date']) && in_array($direction, ['asc', 'desc'])) {
            $query->orderBy($sort, $direction);
        }

        $treatments = $query->paginate(10)->appends($request->all());
        $patients = Patient::all();
        $dentists = Dentist::all();
        $procedures = Procedure::all();

        return view('dental_management.treatments.index', compact('treatments', 'patients', 'dentists', 'procedures'));
    }

    public function create()
    {
        $patients = Patient::all();
        $dentists = Dentist::all();
        $procedures = Procedure::all();
        return view('dental_management.treatments.create', compact('patients', 'dentists', 'procedures'));
    }

    public function store(StoreRequest $request, TreatmentService $service)
    {
        $service->create($request->validated());
        return redirect()->route('dental_management.treatments.index')->with('success', __('treatments.created_success'));
    }

    public function show(Treatment $treatment)
    {
        return view('dental_management.treatments.show', compact('treatment'));
    }

    public function edit(Treatment $treatment)
    {
        $patients = Patient::all();
        $dentists = Dentist::all();
        $procedures = Procedure::all();
        return view('dental_management.treatments.edit', compact('treatment', 'patients', 'dentists', 'procedures'));
    }

    public function update(UpdateRequest $request, Treatment $treatment, TreatmentService $service)
    {
        $service->update($treatment, $request->validated());
        return redirect()->route('dental_management.treatments.index')->with('success', __('treatments.updated_success'));
    }

    public function delete(Treatment $treatment)
    {
        return view('dental_management.treatments.delete', compact('treatment'));
    }

    public function deleteSave(DeleteRequest $request, Treatment $treatment, TreatmentService $service)
    {
        $service->delete($treatment, $request->deleted_description);
        return redirect()->route('dental_management.treatments.index')->with('success', __('treatments.deleted_success'));
    }
}