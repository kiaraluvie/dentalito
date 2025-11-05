<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="patient_id">{{ __('appointments.fields.patient') }}</label>
            <select name="patient_id" id="patient_id" class="form-control @error('patient_id') is-invalid @enderror" required>
                <option value="">{{ __('global.select') }}</option>
                @foreach ($patients as $patient)
                    <option value="{{ $patient->id }}" {{ old('patient_id', $appointment->patient_id ?? '') == $patient->id ? 'selected' : '' }}>{{ $patient->name }} {{ $patient->lastname }}</option>
                @endforeach
            </select>
            @error('patient_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="dentist_id">{{ __('appointments.fields.dentist') }}</label>
            <select name="dentist_id" id="dentist_id" class="form-control @error('dentist_id') is-invalid @enderror" required>
                <option value="">{{ __('global.select') }}</option>
                @foreach ($dentists as $dentist)
                    <option value="{{ $dentist->id }}" {{ old('dentist_id', $appointment->dentist_id ?? '') == $dentist->id ? 'selected' : '' }}>{{ $dentist->user->name }}</option>
                @endforeach
            </select>
            @error('dentist_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="appointment_date">{{ __('appointments.fields.appointment_date') }}</label>
            <input type="date" name="appointment_date" id="appointment_date" class="form-control @error('appointment_date') is-invalid @enderror" value="{{ old('appointment_date', $appointment->appointment_date ?? '') }}" required>
            @error('appointment_date')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="start_time">{{ __('appointments.fields.start_time') }}</label>
            <input type="time" name="start_time" id="start_time" class="form-control @error('start_time') is-invalid @enderror" value="{{ old('start_time', $appointment->start_time ?? '') }}" required>
            @error('start_time')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="end_time">{{ __('appointments.fields.end_time') }}</label>
            <input type="time" name="end_time" id="end_time" class="form-control @error('end_time') is-invalid @enderror" value="{{ old('end_time', $appointment->end_time ?? '') }}" required>
            @error('end_time')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="reason">{{ __('appointments.fields.reason') }}</label>
            <textarea name="reason" id="reason" class="form-control @error('reason') is-invalid @enderror">{{ old('reason', $appointment->reason ?? '') }}</textarea>
            @error('reason')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="notes">{{ __('appointments.fields.notes') }}</label>
            <textarea name="notes" id="notes" class="form-control @error('notes') is-invalid @enderror">{{ old('notes', $appointment->notes ?? '') }}</textarea>
            @error('notes')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="status">{{ __('appointments.fields.status') }}</label>
            <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                <option value="Scheduled" {{ old('status', $appointment->status ?? '') == 'Scheduled' ? 'selected' : '' }}>{{ __('appointments.status_scheduled') }}</option>
                <option value="Completed" {{ old('status', $appointment->status ?? '') == 'Completed' ? 'selected' : '' }}>{{ __('appointments.status_completed') }}</option>
                <option value="Canceled" {{ old('status', $appointment->status ?? '') == 'Canceled' ? 'selected' : '' }}>{{ __('appointments.status_canceled') }}</option>
                <option value="No Show" {{ old('status', $appointment->status ?? '') == 'No Show' ? 'selected' : '' }}>{{ __('appointments.status_no_show') }}</option>
            </select>
            @error('status')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <div class="custom-control custom-switch">
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" value="1" {{ old('is_active', isset($appointment) && $appointment->is_active) ? 'checked' : '' }}>
                <label class="custom-control-label" for="is_active">{{ __('appointments.fields.is_active') }}</label>
            </div>
            @error('is_active')
                <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
</div>
