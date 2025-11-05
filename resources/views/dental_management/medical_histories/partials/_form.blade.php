<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="patient_id">{{ __('medical_histories.fields.patient') }}</label>
            <select name="patient_id" id="patient_id" class="form-control @error('patient_id') is-invalid @enderror" required>
                <option value="">{{ __('global.select') }}</option>
                @foreach ($patients as $patient)
                    <option value="{{ $patient->id }}" {{ old('patient_id', $medicalHistory->patient_id ?? '') == $patient->id ? 'selected' : '' }}>{{ $patient->name }} {{ $patient->lastname }}</option>
                @endforeach
            </select>
            @error('patient_id')
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
            <label for="allergies">{{ __('medical_histories.fields.allergies') }}</label>
            <textarea name="allergies" id="allergies" class="form-control @error('allergies') is-invalid @enderror">{{ old('allergies', $medicalHistory->allergies ?? '') }}</textarea>
            @error('allergies')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="chronic_diseases">{{ __('medical_histories.fields.chronic_diseases') }}</label>
            <textarea name="chronic_diseases" id="chronic_diseases" class="form-control @error('chronic_diseases') is-invalid @enderror">{{ old('chronic_diseases', $medicalHistory->chronic_diseases ?? '') }}</textarea>
            @error('chronic_diseases')
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
            <label for="medications">{{ __('medical_histories.fields.medications') }}</label>
            <textarea name="medications" id="medications" class="form-control @error('medications') is-invalid @enderror">{{ old('medications', $medicalHistory->medications ?? '') }}</textarea>
            @error('medications')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="surgical_history">{{ __('medical_histories.fields.surgical_history') }}</label>
            <textarea name="surgical_history" id="surgical_history" class="form-control @error('surgical_history') is-invalid @enderror">{{ old('surgical_history', $medicalHistory->surgical_history ?? '') }}</textarea>
            @error('surgical_history')
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
            <label for="family_history">{{ __('medical_histories.fields.family_history') }}</label>
            <textarea name="family_history" id="family_history" class="form-control @error('family_history') is-invalid @enderror">{{ old('family_history', $medicalHistory->family_history ?? '') }}</textarea>
            @error('family_history')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="observations">{{ __('medical_histories.fields.observations') }}</label>
            <textarea name="observations" id="observations" class="form-control @error('observations') is-invalid @enderror">{{ old('observations', $medicalHistory->observations ?? '') }}</textarea>
            @error('observations')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
</div>
