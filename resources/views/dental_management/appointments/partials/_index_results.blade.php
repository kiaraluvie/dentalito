<table class="table table-hover">
    <thead class="bg-light">
        <tr>
            <th>{{ __('appointments.fields.patient') }}</th>
            <th>{{ __('appointments.fields.dentist') }}</th>
            <th>{{ __('appointments.fields.appointment_date') }}</th>
            <th>{{ __('appointments.fields.start_time') }}</th>
            <th>{{ __('appointments.fields.status') }}</th>
            <th width="150px">{{ __('global.actions') }}</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($appointments as $appointment)
            <tr>
                <td>{{ $appointment->patient->name }} {{ $appointment->patient->lastname }}</td>
                <td>{{ $appointment->dentist->user->name }}</td>
                <td>{{ $appointment->appointment_date }}</td>
                <td>{{ $appointment->start_time }}</td>
                <td>{{ $appointment->status }}</td>
                <td>
                    <div class="btn-group btn-group-sm" role="group">
                        @if ($appointment->slug)
                            @can('appointments.view')
                            <a class="btn btn-light" href="{{ route('dental_management.appointments.show', $appointment) }}" title="{{ __('global.show') }}">
                                <i class="fas fa-eye"></i>
                            </a>
                            @endcan
                            @can('appointments.edit')
                            <a class="btn btn-light" href="{{ route('dental_management.appointments.edit', $appointment) }}" title="{{ __('global.edit') }}">
                                <i class="fas fa-pen"></i>
                            </a>
                            @endcan
                            @can('appointments.delete')
                            <a class="btn btn-light" href="{{ route('dental_management.appointments.delete', $appointment) }}" title="{{ __('global.delete') }}">
                                <i class="fas fa-trash"></i>
                            </a>
                            @endcan
                        @endif
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="text-center">{{ __('appointments.no_appointments_found') }}</td>
            </tr>
        @endforelse
    </tbody>
</table>
