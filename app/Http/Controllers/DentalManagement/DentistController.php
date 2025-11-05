<?php

// Namespace
namespace App\Http\Controllers\DentalManagement;

// Controllers
use App\Http\Controllers\Controller;

// Models
use App\Models\Dentist;
use App\Models\Specialty;

// Requests
use App\Http\Requests\DentalManagement\Dentist\StoreRequest;
use App\Http\Requests\DentalManagement\Dentist\UpdateRequest;
use App\Http\Requests\DentalManagement\Dentist\DeleteRequest;

// Services
use App\Services\DentalManagement\DentistService;

// Illuminates
use Illuminate\Http\Request;

// Main class
class DentistController extends Controller
{
    // Action Index
    public function index(Request $request)
    {
        $dentists = Dentist::with(['user', 'specialties']) // 👈 incluimos specialties
            ->filter($request)
            ->paginate(10)
            ->appends($request->all());

        return view('dental_management.dentists.index', compact('dentists'));
    }

    // Action Create
    public function create()
    {
        // 👇 Cargar todas las especialidades disponibles para el formulario
        $specialties = Specialty::orderBy('name')->get();

        return view('dental_management.dentists.create', compact('specialties'));
    }


    // Action Insert data from view create.blade.php
    public function store(StoreRequest $request, DentistService $service)
    {
        // Crear dentista y asignar especialidades
        $service->create($request->validated(), $request->input('specialties', []));

        return redirect()
            ->route('dental_management.dentists.index')
            ->with('success', __('global.created_success'));
    }

    // Action Show
    public function show($slug)
    {
        $dentist = Dentist::with(['user', 'specialties'])->withTrashed()->where('slug', $slug)->firstOrFail();

        return view('dental_management.dentists.show', compact('dentist'));
    }

    public function edit(Dentist $dentist)
    {
        // 👇 Obtener todas las especialidades para seleccionar en la vista
        $specialties = Specialty::orderBy('name')->get();

        return view('dental_management.dentists.edit', compact('dentist', 'specialties'));
    }

    // Action Update data from view edit.blade.php
    public function update(UpdateRequest $request, Dentist $dentist, DentistService $service)
    {
        // Actualizar dentista y sincronizar especialidades
        $service->update($dentist, $request->validated(), $request->input('specialties', []));

        return redirect()
            ->route('dental_management.dentists.index')
            ->with('success', __('global.updated_success'));
    }

    // Action Delete
    public function delete(Dentist $dentist)
    {
        // Displays delete.blade.php
        return view('dental_management.dentists.delete', compact('dentist'));
    }

    // Action Update column deleted_at (hide from view)
    public function deleteSave(DeleteRequest $request, Dentist $dentist, DentistService $service)
    {
        // Using Service from app/Services
        $service->delete($dentist, $request->deleted_description);

        // Redirect to view with success message
        return redirect()
            ->route('dental_management.dentists.index')
            ->with('success', __('global.deleted_success'));
    }

    // Edit All View (like index but with inline editing)
    public function editAll(Request $request, Dentist $dentist)
    {
        // Base query using scope 'notDeleted' from the model
        $query = $dentist::query();

        // Apply filters
        $query = $query->filter($request);

        // Order
        $sort = $request->get('sort', 'id');
        $direction = $request->get('direction', 'asc');

        if (in_array($sort, ['id', 'first_name', 'last_name', 'specialty', 'email', 'is_active']) && in_array($direction, ['asc', 'desc'])) {
            $query->orderBy($sort, $direction);
        }

        // Pagination for 10 rows
        $dentists = $query->paginate(10)->appends($request->all());

        return view('dental_management.dentists.edit_all', compact('dentists'));
    }

    // Action Update inline
    public function updateInline(Request $request)
    {
        $dentist = Dentist::findOrFail($request->id);
        $dentist->{$request->field} = $request->value;
        $dentist->save();

        return response()->json(['success' => true]);
    }

    // Export PDF (background download)
    public function exportPdf(Request $request)
    {
        \App\Jobs\DentalManagement\Dentists\GenerateDentistsPdfJob::dispatch(
            auth()->id(),
            $request->all()
        );

        return redirect()
            ->route('download_management.user_downloads.index')
            ->with('success', __('global.download_in_queue'));
    }

    // Export Excel (background download)
    public function exportExcel(Request $request)
    {
        \App\Jobs\DentalManagement\Dentists\GenerateDentistsExcelJob::dispatch(
            auth()->id(),
            $request->all()
        );

        return redirect()
            ->route('download_management.user_downloads.index')
            ->with('success', __('global.download_in_queue'));
    }

    // Export Word (background download)
    public function exportWord(Request $request)
    {
        \App\Jobs\DentalManagement\Dentists\GenerateDentistsWordJob::dispatch(
            auth()->id(),
            $request->all()
        );

        return redirect()
            ->route('download_management.user_downloads.index')
            ->with('success', __('global.download_in_queue'));
    }
}

