<?php

namespace App\Http\Controllers\DentalManagement;
use App\Http\Controllers\Controller;
use App\Models\Specialty;
use Illuminate\Http\Request;

class SpecialtyController extends Controller
{
    public function index(Request $request)
    {
        $query = Specialty::query();

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        $sort = $request->get('sort', 'name');
        $direction = $request->get('direction', 'asc');
        if (in_array($sort, ['id', 'name']) && in_array($direction, ['asc', 'desc'])) {
            $query->orderBy($sort, $direction);
        } else {
            $query->orderBy('name');
        }

        $specialties = $query->paginate(10)->appends($request->all());

        return view('dental_management.especialties.index', compact('specialties'));
    }

    public function create()
    {
        return view('dental_management.especialties.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:specialties,name',
            'description' => 'nullable|string',
        ]);

        Specialty::create($request->only('name', 'description'));

        return redirect()->route('dental_management.specialties.index')->with('success', __('specialty.created_success'));
    }

    public function show(Specialty $specialty)
    {
        return view('dental_management.especialties.show', compact('specialty'));
    }

    public function edit(Specialty $specialty)
    {
        return view('dental_management.especialties.edit', compact('specialty'));
    }

    public function update(Request $request, Specialty $specialty)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:specialties,name,' . $specialty->id,
            'description' => 'nullable|string',
        ]);

        $specialty->update($request->only('name', 'description'));

        return redirect()->route('dental_management.specialties.index')->with('success', __('specialty.updated_success'));
    }

    public function destroy(Specialty $specialty)
    {
        $specialty->delete();

        return redirect()->route('dental_management.specialties.index')->with('success', __('specialty.deleted_success'));
    }

    public function delete(Specialty $specialty)
    {
        return view('dental_management.especialties.delete', compact('specialty'));
    }

    public function deleteSave(Request $request, Specialty $specialty)
    {
        // Optionally capture deleted_description if needed
        $specialty->delete();
        return redirect()->route('dental_management.specialties.index')->with('success', __('specialty.deleted_success'));
    }
}
