<table class="table table-hover">
    <thead class="bg-light">
        <tr>
            <th>
                <a class="text-dark text-decoration-none" href="{{ route('dental_management.treatments.index', array_merge(request()->all(), ['sort' => 'date', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc'])) }}">
                    {{ __('treatments.fields.date') }}
                </a>
            </th>
            <th>{{ __('treatments.fields.patient') }}</th>
            <th>{{ __('treatments.fields.dentist') }}</th>
            <th>{{ __('treatments.fields.procedure') }}</th>
            <th>{{ __('treatments.fields.price') }}</th>
            <th>{{ __('treatments.fields.status') }}</th>
            <th width="150px">{{ __('global.actions') }}</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($treatments as $treatment)
            <tr>
                <td>{{ $treatment->date }}</td>
                <td>{{ $treatment->patient->name }} {{ $treatment->patient->lastname }}</td>
                <td>{{ $treatment->dentist->user->name }}</td>
                <td>{{ $treatment->procedure->name }}</td>
                <td>{{ $treatment->price }}</td>
                <td>
                    <span class="badge badge-{{ __('treatments.status_colors.' . $treatment->status) }}">
                        {{ __('treatments.status.' . $treatment->status) }}
                    </span>
                </td>
                <td>
                    <div class="btn-group btn-group-sm" role="group">
                        @if ($treatment->slug)
                            @can('treatments.view')
                            <a class="btn btn-light" href="{{ route('dental_management.treatments.show', $treatment) }}" title="{{ __('global.show') }}">
                                <i class="fas fa-eye"></i>
                            </a>
                            @endcan
                            @can('treatments.edit')
                            <a class="btn btn-light" href="{{ route('dental_management.treatments.edit', $treatment) }}" title="{{ __('global.edit') }}">
                                <i class="fas fa-pen"></i>
                            </a>
                            @endcan
                            @can('treatments.delete')
                            <a class="btn btn-light" href="{{ route('dental_management.treatments.delete', $treatment) }}" title="{{ __('global.delete') }}">
                                <i class="fas fa-trash"></i>
                            </a>
                            @endcan
                        @endif
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-center">{{ __('treatments.no_treatments_found') }}</td>
            </tr>
        @endforelse
    </tbody>
</table>
