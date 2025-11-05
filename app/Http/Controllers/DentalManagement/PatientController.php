<?php

namespace App\Http\Controllers\DentalManagement;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\Tenant;
use App\Models\Locale;
use Illuminate\Http\Request;
use App\Services\DentalManagement\PatientService;
use App\Http\Requests\DentalManagement\Patient\StoreRequest;
use App\Http\Requests\DentalManagement\Patient\UpdateRequest;
use App\Http\Requests\DentalManagement\Patient\DeleteRequest;

class PatientController extends Controller
{
public function index(Request $request)
{
    $query = Patient::query();

        // Filtrar por tenant actual
        $tenantId = auth()->user()->tenant_id ?? session('tenant_id');
        $query->where('tenant_id', $tenantId);

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }
        if ($request->filled('lastname')) {
            $query->where('lastname', 'like', '%' . $request->lastname . '%');
        }
        if ($request->filled('dni')) {
            $query->where('dni', 'like', '%' . $request->dni . '%');
        }

        $sort = $request->get('sort', 'id');
        $direction = $request->get('direction', 'asc');

        if (in_array($sort, ['id', 'name', 'lastname', 'dni']) && in_array($direction, ['asc', 'desc'])) {
            $query->orderBy($sort, $direction);
        }

        $patients = $query->paginate(10)->appends($request->all());

        return view('dental_management.patients.index', compact('patients'));
    }

    public function create()
    {
        $locales = Locale::all();
        $tenantId = auth()->user()->tenant_id ?? session('tenant_id');
        $tenant = Tenant::findOrFail($tenantId);
        return view('dental_management.patients.create', compact('locales', 'tenant'));
    }

    public function store(StoreRequest $request, PatientService $service)
    {
        // Agregar tenant_id ANTES de validar
        $request->merge([
            'tenant_id' => auth()->user()->tenant_id ?? session('tenant_id'),
        ]);

        $data = $request->validated();

        $service->create($data);

        return redirect()->route('dental_management.patients.index')
            ->with('success', __('patients.created_success'));
    }



    public function show(Patient $patient)
    {
        return view('dental_management.patients.show', compact('patient'));
        $patient->load('medicalHistory');
        return view('dental_management.patients.show', compact('patient'));
    }

    public function edit(Patient $patient)
    {
        $locales = Locale::all();
        return view('dental_management.patients.edit', compact('patient', 'locales'));
    }

    public function update(UpdateRequest $request, Patient $patient, PatientService $service)
    {
        $this->authorizeTenant($patient);

        $request->merge([
            'tenant_id' => auth()->user()->tenant_id ?? session('tenant_id'),
        ]);

        $data = $request->validated();

        $service->update($patient, $data);

        return redirect()
            ->route('dental_management.patients.show', $patient->slug)
            ->with('success', __('patients.updated_success'));
    }



    public function delete(Patient $patient)
    {
        return view('dental_management.patients.delete', compact('patient'));
    }

    public function deleteSave(DeleteRequest $request, Patient $patient, PatientService $service)
    {
        $this->authorizeTenant($patient);

        $service->delete($patient, $request->deleted_description);
        return redirect()->route('dental_management.patients.index')
            ->with('success', __('patients.deleted_success'));
    }
    protected function authorizeTenant($patient)
    {
        $tenantId = auth()->user()->tenant_id ?? session('tenant_id');
        abort_if($patient->tenant_id !== $tenantId, 403, 'Acción no autorizada.');
    }
}
