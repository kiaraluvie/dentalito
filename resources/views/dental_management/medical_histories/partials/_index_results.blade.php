<table class="table table-hover">
    <thead class="bg-light">
        <tr>
            <th>{{ __('medical_histories.fields.patient') }}</th>
            <th width="150px">{{ __('global.actions') }}</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($medicalHistories as $medicalHistory)
            <tr>
                <td>{{ $medicalHistory->patient->name }} {{ $medicalHistory->patient->lastname }}</td>
                <td>
                    <div class="btn-group btn-group-sm" role="group">
                        @if ($medicalHistory->slug)
                            @can('medical_histories.view')
                            <a class="btn btn-light" href="{{ route('dental_management.medical_histories.show', $medicalHistory) }}" title="{{ __('global.show') }}">
                                <i class="fas fa-eye"></i>
                            </a>
                            @endcan
                            @can('medical_histories.edit')
                            <a class="btn btn-light" href="{{ route('dental_management.medical_histories.edit', $medicalHistory) }}" title="{{ __('global.edit') }}">
                                <i class="fas fa-pen"></i>
                            </a>
                            @endcan
                            @can('medical_histories.delete')
                            <a class="btn btn-light" href="{{ route('dental_management.medical_histories.delete', $medicalHistory) }}" title="{{ __('global.delete') }}">
                                <i class="fas fa-trash"></i>
                            </a>
                            @endcan
                        @endif
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="2" class="text-center">{{ __('medical_histories.no_medical_histories_found') }}</td>
            </tr>
        @endforelse
    </tbody>
</table>
