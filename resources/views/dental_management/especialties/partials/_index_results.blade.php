<table class="table table-hover">
    <thead class="bg-light">
        <tr>
            <th>{{ __('specialty.fields.name') }}</th>
            <th>{{ __('specialty.fields.description') }}</th>
            <th width="150px">{{ __('global.actions') }}</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($specialties as $specialty)
            <tr>
                <td>{{ $specialty->name }}</td>
                <td>{{ $specialty->description }}</td>
                <td>
                    <div class="btn-group btn-group-sm" role="group">
                        @if ($specialty)
                            @can('specialties.view')
                            <a class="btn btn-light" href="{{ route('dental_management.specialties.show', $specialty) }}" title="{{ __('global.show') }}">
                                <i class="fas fa-eye"></i>
                            </a>
                            @endcan
                            @can('specialties.edit')
                            <a class="btn btn-light" href="{{ route('dental_management.specialties.edit', $specialty) }}" title="{{ __('global.edit') }}">
                                <i class="fas fa-pen"></i>
                            </a>
                            @endcan
                            @can('specialties.delete')
                            <a class="btn btn-light" href="{{ route('dental_management.specialties.delete', $specialty) }}" title="{{ __('global.delete') }}">
                                <i class="fas fa-trash"></i>
                            </a>
                            @endcan
                        @endif
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="3" class="text-center">{{ __('specialty.no_specialties_found') }}</td>
            </tr>
        @endforelse
    </tbody>
</table>
