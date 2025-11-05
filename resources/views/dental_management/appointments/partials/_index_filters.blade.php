<form action="{{ route('dental_management.appointments.index') }}" method="GET" class="mb-3">
  <div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label for="patient_id">{{ __('appointments.fields.patient') }}</label>
            <select name="patient_id" id="patient_id" class="form-control">
                <option value="">{{ __('global.all') }}</option>
                @foreach ($patients as $patient)
                    <option value="{{ $patient->id }}" {{ request('patient_id') == $patient->id ? 'selected' : '' }}>{{ $patient->name }} {{ $patient->lastname }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="dentist_id">{{ __('appointments.fields.dentist') }}</label>
            <select name="dentist_id" id="dentist_id" class="form-control">
                <option value="">{{ __('global.all') }}</option>
                @foreach ($dentists as $dentist)
                    <option value="{{ $dentist->id }}" {{ request('dentist_id') == $dentist->id ? 'selected' : '' }}>{{ $dentist->user->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-3">
      <label for="date" class="form-label">{{ __('appointments.fields.appointment_date') }}</label>
      <input type="date" name="date" id="date" class="form-control" value="{{ request('date') }}">
    </div>

    <div class="col-md-3">
      <label for="status" class="form-label">{{ __('appointments.fields.status') }}</label>
      <select name="status" id="status" class="form-control">
        <option value="">{{ __('global.all') }}</option>
        <option value="Scheduled" {{ request('status') == 'Scheduled' ? 'selected' : '' }}>{{ __('appointments.status_scheduled') }}</option>
        <option value="Completed" {{ request('status') == 'Completed' ? 'selected' : '' }}>{{ __('appointments.status_completed') }}</option>
        <option value="Canceled" {{ request('status') == 'Canceled' ? 'selected' : '' }}>{{ __('appointments.status_canceled') }}</option>
        <option value="No Show" {{ request('status') == 'No Show' ? 'selected' : '' }}>{{ __('appointments.status_no_show') }}</option>
      </select>
    </div>
  </div>

  <div class="row pt-4">
    <div class="col-md-12 text-center">
      <button type="submit" class="btn btn-primary me-2">
        <i class="fas fa-search"></i> {{ __('global.search') }}
      </button>
      <a href="{{ route('dental_management.appointments.index') }}" class="btn btn-secondary">
        <i class="fas fa-brush"></i> {{ __('global.clear') }}
      </a>
    </div>
  </div>
</form>
