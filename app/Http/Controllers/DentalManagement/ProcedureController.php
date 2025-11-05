<?php

namespace App\Http\Controllers\DentalManagement;

use App\Http\Controllers\Controller;
use App\Models\Procedure;
use Illuminate\Http\Request;
use App\Services\DentalManagement\ProcedureService;
use App\Http\Requests\DentalManagement\Procedure\StoreRequest;
use App\Http\Requests\DentalManagement\Procedure\UpdateRequest;
use App\Http\Requests\DentalManagement\Procedure\DeleteRequest;

class ProcedureController extends Controller
{
    public function index(Request $request)
    {
        $query = Procedure::query();
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }
        $sort = $request->get('sort', 'id');
        $direction = $request->get('direction', 'asc');
        if (in_array($sort, ['id', 'name']) && in_array($direction, ['asc', 'desc'])) {
            $query->orderBy($sort, $direction);
        }
        $procedures = $query->paginate(10)->appends($request->all());
        return view('dental_management.procedures.index', compact('procedures'));
    }

    public function create()
    {
        return view('dental_management.procedures.create');
    }

    public function store(StoreRequest $request, ProcedureService $service)
    {
        $service->create($request->validated());
        return redirect()->route('dental_management.procedures.index')->with('success', __('procedures.created_success'));
    }

    public function show(Procedure $procedure)
    {
        return view('dental_management.procedures.show', compact('procedure'));
    }

    public function edit(Procedure $procedure)
    {
        return view('dental_management.procedures.edit', compact('procedure'));
    }

    public function update(UpdateRequest $request, Procedure $procedure, ProcedureService $service)
    {
        $service->update($procedure, $request->validated());
        return redirect()->route('dental_management.procedures.index')->with('success', __('procedures.updated_success'));
    }

    public function delete(Procedure $procedure)
    {
        return view('dental_management.procedures.delete', compact('procedure'));
    }

    public function deleteSave(DeleteRequest $request, Procedure $procedure, ProcedureService $service)
    {
        $service->delete($procedure, $request->deleted_description);
        return redirect()->route('dental_management.procedures.index')->with('success', __('procedures.deleted_success'));
    }
}