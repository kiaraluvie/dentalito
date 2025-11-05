<table class="table table-hover">
    <thead class="bg-light">
        <tr>
            <th>
                <a class="text-dark text-decoration-none" href="{{ route('dental_management.patients.index', array_merge(request()->all(), ['sort' => 'name', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc'])) }}">
                    {{ __('patients.fields.name') }}
                </a>
            </th>
            <th>
                <a class="text-dark text-decoration-none" href="{{ route('dental_management.patients.index', array_merge(request()->all(), ['sort' => 'lastname', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc'])) }}">
                    {{ __('patients.fields.lastname') }}
                </a>
            </th>
            <th>
                <a class="text-dark text-decoration-none" href="{{ route('dental_management.patients.index', array_merge(request()->all(), ['sort' => 'dni', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc'])) }}">
                    {{ __('patients.fields.dni') }}
                </a>
            </th>
            <th>{{ __('patients.fields.email') }}</th>
            <th>{{ __('patients.fields.phone') }}</th>
            <th width="150px">{{ __('global.actions') }}</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($patients as $patient)
            <tr>
                <td>{{ $patient->name }}</td>
                <td>{{ $patient->lastname }}</td>
                <td>{{ $patient->dni }}</td>
                <td>{{ $patient->email }}</td>
                <td>{{ $patient->phone }}</td>
                <td>
                    <div class="btn-group btn-group-sm" role="group">
                        @can('patients.view')
                        <a class="btn btn-light" href="{{ route('dental_management.patients.show', $patient) }}" title="{{ __('global.show') }}">
                            <i class="fas fa-eye"></i>
                        </a>
                        @endcan
                        @can('patients.edit')
                        <a class="btn btn-light" href="{{ route('dental_management.patients.edit', $patient) }}" title="{{ __('global.edit') }}">
                            <i class="fas fa-pen"></i>
                        </a>
                        @endcan
                        @can('patients.delete')
                        <a class="btn btn-light" href="{{ route('dental_management.patients.delete', $patient) }}" title="{{ __('global.delete') }}">
                            <i class="fas fa-trash"></i>
                        </a>
                        @endcan
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="text-center">{{ __('patients.no_patients_found') }}</td>
            </tr>
        @endforelse
    </tbody>
</table>
