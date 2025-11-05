<?php

namespace App\Http\Controllers\DentalManagement;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Patient;
use App\Models\Dentist;
use Illuminate\Http\Request;
use App\Services\DentalManagement\AppointmentService;
use App\Http\Requests\DentalManagement\Appointment\StoreRequest;
use App\Http\Requests\DentalManagement\Appointment\UpdateRequest;
use App\Http\Requests\DentalManagement\Appointment\DeleteRequest;

class AppointmentController extends Controller
{
    public function index(Request $request)
    {
        $query = Appointment::with(['patient', 'dentist.user']);

        if ($request->filled('patient_id')) {
            $query->where('patient_id', $request->patient_id);
        }

        if ($request->filled('dentist_id')) {
            $query->where('dentist_id', $request->dentist_id);
        }

        if ($request->filled('date')) {
            $query->whereDate('date', $request->date);
        }

        $sort = $request->get('sort', 'id');
        $direction = $request->get('direction', 'asc');
        if (in_array($sort, ['id', 'date']) && in_array($direction, ['asc', 'desc'])) {
            $query->orderBy($sort, $direction);
        }

        $appointments = $query->paginate(10)->appends($request->all());
        $patients = Patient::all();
        $dentists = Dentist::with('user')->get();

        return view('dental_management.appointments.index', compact('appointments', 'patients', 'dentists'));
    }

    public function create()
    {
        $patients = Patient::all();
        $dentists = Dentist::with('user')->get();
        return view('dental_management.appointments.create', compact('patients', 'dentists'));
    }

    public function store(StoreRequest $request, AppointmentService $service)
    {
        $service->create($request->validated());
        return redirect()->route('dental_management.appointments.index')->with('success', __('appointments.created_success'));
    }

    public function show(Appointment $appointment)
    {
        return view('dental_management.appointments.show', compact('appointment'));
    }

    public function edit(Appointment $appointment)
    {
        $patients = Patient::all();
        $dentists = Dentist::with('user')->get();
        return view('dental_management.appointments.edit', compact('appointment', 'patients', 'dentists'));
    }

    public function update(UpdateRequest $request, Appointment $appointment, AppointmentService $service)
    {
        $service->update($appointment, $request->validated());
        return redirect()->route('dental_management.appointments.index')->with('success', __('appointments.updated_success'));
    }

    public function delete(Appointment $appointment)
    {
        return view('dental_management.appointments.delete', compact('appointment'));
    }

    public function deleteSave(DeleteRequest $request, Appointment $appointment, AppointmentService $service)
    {
        $service->delete($appointment, $request->deleted_description);
        return redirect()->route('dental_management.appointments.index')->with('success', __('appointments.deleted_success'));
    }
}