<table class="table table-hover">
    <thead class="bg-light">
        <tr>
            <th>
                <a class="text-dark text-decoration-none" href="{{ route('dental_management.dentists.index', array_merge(request()->all(), ['sort' => 'name', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc'])) }}">
                    {{ __('dentists.fields.name') }}
                </a>
            </th>
            <th>
                <a class="text-dark text-decoration-none" href="{{ route('dental_management.dentists.index', array_merge(request()->all(), ['sort' => 'email', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc'])) }}">
                    {{ __('dentists.fields.email') }}
                </a>
            </th>
            <th>
                <a class="text-dark text-decoration-none" href="{{ route('dental_management.dentists.index', array_merge(request()->all(), ['sort' => 'specialty', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc'])) }}">
                    {{ __('dentists.fields.specialty') }}
                </a>
            </th>
            <th>{{ __('dentists.fields.phone') }}</th>
            <th>{{ __('dentists.fields.is_active') }}</th>
            <th width="150px">{{ __('global.actions') }}</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($dentists as $dentist)
            <tr>
                <td>{{ $dentist->user->name }}</td>
                <td>{{ $dentist->user->email }}</td> 
                
                <td>
                    @if($dentist->specialties->count() > 0)
                        {{ $dentist->specialties->pluck('name')->join(', ') }}
                    @else
                        <em>{{ __('global.not_assigned') }}</em>
                    @endif
                </td>

                <td>{{ $dentist->phone }}</td>
                <td>{!! $dentist->is_active ? '<span class="badge badge-success">Activo</span>' : '<span class="badge badge-danger">Inactivo</span>' !!}</td>
                <td>
                    <div class="btn-group btn-group-sm" role="group">
                        @can('dentists.view')
                        <a class="btn btn-light" href="{{ route('dental_management.dentists.show', $dentist->slug) }}" title="{{ __('global.show') }}">
                            <i class="fas fa-eye"></i>
                        </a>
                        @endcan
                        @can('dentists.edit')
                        <a class="btn btn-light" href="{{ route('dental_management.dentists.edit', $dentist) }}" title="{{ __('global.edit') }}">
                            <i class="fas fa-pen"></i>
                        </a>
                        @endcan
                        @can('dentists.delete')
                        <a class="btn btn-light" href="{{ route('dental_management.dentists.delete', $dentist) }}" title="{{ __('global.delete') }}">
                            <i class="fas fa-trash"></i>
                        </a>
                        @endcan
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="text-center">{{ __('dentists.no_dentists_found') }}</td>
            </tr>
        @endforelse
    </tbody>
</table>
