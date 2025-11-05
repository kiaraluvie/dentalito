<form action="{{ route('dental_management.medical_histories.index') }}" method="GET">
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="patient_id">{{ __('medical_histories.fields.patient') }}</label>
                <select name="patient_id" id="patient_id" class="form-control">
                    <option value="">{{ __('global.all') }}</option>
                    @foreach ($patients as $patient)
                        <option value="{{ $patient->id }}" {{ request('patient_id') == $patient->id ? 'selected' : '' }}>{{ $patient->name }} {{ $patient->lastname }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-12 mt-3 text-right">
            <button type="submit" class="btn btn-primary">{{ __('global.filter') }}</button>
            <a href="{{ route('dental_management.medical_histories.index') }}" class="btn btn-secondary">{{ __('global.clear_filter') }}</a>
        </div>
    </div>
</form>
