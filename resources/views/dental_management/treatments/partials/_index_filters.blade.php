<form action="{{ route('dental_management.treatments.index') }}" method="GET">
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label for="patient_id">{{ __('treatments.fields.patient') }}</label>
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
                <label for="dentist_id">{{ __('treatments.fields.dentist') }}</label>
                <select name="dentist_id" id="dentist_id" class="form-control">
                    <option value="">{{ __('global.all') }}</option>
                    @foreach ($dentists as $dentist)
                        <option value="{{ $dentist->id }}" {{ request('dentist_id') == $dentist->id ? 'selected' : '' }}>{{ $dentist->user->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="procedure_id">{{ __('treatments.fields.procedure') }}</label>
                <select name="procedure_id" id="procedure_id" class="form-control">
                    <option value="">{{ __('global.all') }}</option>
                    @foreach ($procedures as $procedure)
                        <option value="{{ $procedure->id }}" {{ request('procedure_id') == $procedure->id ? 'selected' : '' }}>{{ $procedure->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="date">{{ __('treatments.fields.date') }}</label>
                <input type="date" name="date" id="date" class="form-control" value="{{ request('date') }}">
            </div>
        </div>
        <div class="col-md-12 mt-3 text-right">
            <button type="submit" class="btn btn-primary">{{ __('global.filter') }}</button>
            <a href="{{ route('dental_management.treatments.index') }}" class="btn btn-secondary">{{ __('global.clear_filter') }}</a>
        </div>
    </div>
</form>
