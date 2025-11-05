<table class="table table-hover">
    <thead class="bg-light">
        <tr>
            <th>
                <a class="text-dark text-decoration-none" href="{{ route('dental_management.procedures.index', array_merge(request()->all(), ['sort' => 'name', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc'])) }}">
                    {{ __('procedures.fields.name') }}
                </a>
            </th>
            <th>{{ __('procedures.fields.price') }}</th>
            <th>{{ __('procedures.fields.is_active') }}</th>
            <th width="150px">{{ __('global.actions') }}</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($procedures as $procedure)
            <tr>
                <td>{{ $procedure->name }}</td>
                <td>{{ $procedure->price }}</td>
                <td>
                    @if ($procedure->is_active)
                        <span class="badge badge-success">{{ __('global.active') }}</span>
                    @else
                        <span class="badge badge-danger">{{ __('global.inactive') }}</span>
                    @endif
                </td>
                <td>
                    <div class="btn-group btn-group-sm" role="group">
                        @if ($procedure->slug)
                            @can('procedures.view')
                            <a class="btn btn-light" href="{{ route('dental_management.procedures.show', $procedure) }}" title="{{ __('global.show') }}">
                                <i class="fas fa-eye"></i>
                            </a>
                            @endcan
                            @can('procedures.edit')
                            <a class="btn btn-light" href="{{ route('dental_management.procedures.edit', $procedure) }}" title="{{ __('global.edit') }}">
                                <i class="fas fa-pen"></i>
                            </a>
                            @endcan
                            @can('procedures.delete')
                            <a class="btn btn-light" href="{{ route('dental_management.procedures.delete', $procedure) }}" title="{{ __('global.delete') }}">
                                <i class="fas fa-trash"></i>
                            </a>
                            @endcan
                        @endif
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="text-center">{{ __('procedures.no_procedures_found') }}</td>
            </tr>
        @endforelse
    </tbody>
</table>
