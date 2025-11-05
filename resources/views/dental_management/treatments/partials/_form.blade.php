<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="patient_id">{{ __('treatments.fields.patient') }}</label>
            <select name="patient_id" id="patient_id" class="form-control @error('patient_id') is-invalid @enderror" required>
                <option value="">{{ __('global.select') }}</option>
                @foreach ($patients as $patient)
                    <option value="{{ $patient->id }}" {{ old('patient_id', $treatment->patient_id ?? '') == $patient->id ? 'selected' : '' }}>{{ $patient->name }} {{ $patient->lastname }}</option>
                @endforeach
            </select>
            @error('patient_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="dentist_id">{{ __('treatments.fields.dentist') }}</label>
            <select name="dentist_id" id="dentist_id" class="form-control @error('dentist_id') is-invalid @enderror" required>
                <option value="">{{ __('global.select') }}</option>
                @foreach ($dentists as $dentist)
                    <option value="{{ $dentist->id }}" {{ old('dentist_id', $treatment->dentist_id ?? '') == $dentist->id ? 'selected' : '' }}>{{ $dentist->user->name }}</option>
                @endforeach
            </select>
            @error('dentist_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="procedure_id">{{ __('treatments.fields.procedure') }}</label>
            <select name="procedure_id" id="procedure_id" class="form-control @error('procedure_id') is-invalid @enderror" required>
                <option value="">{{ __('global.select') }}</option>
                @foreach ($procedures as $procedure)
                    <option value="{{ $procedure->id }}" {{ old('procedure_id', $treatment->procedure_id ?? '') == $procedure->id ? 'selected' : '' }}>{{ $procedure->name }}</option>
                @endforeach
            </select>
            @error('procedure_id')
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
            <label for="date">{{ __('treatments.fields.date') }}</label>
            <input type="date" name="date" id="date" class="form-control @error('date') is-invalid @enderror" value="{{ old('date', $treatment->date ?? '') }}" required>
            @error('date')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="price">{{ __('treatments.fields.price') }}</label>
            <input type="number" name="price" id="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price', $treatment->price ?? '') }}" required step="0.01" min="0">
            @error('price')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="status">{{ __('treatments.fields.status') }}</label>
            <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                <option value="pending" {{ old('status', $treatment->status ?? '') == 'pending' ? 'selected' : '' }}>{{ __('treatments.status.pending') }}</option>
                <option value="in_progress" {{ old('status', $treatment->status ?? '') == 'in_progress' ? 'selected' : '' }}>{{ __('treatments.status.in_progress') }}</option>
                <option value="completed" {{ old('status', $treatment->status ?? '') == 'completed' ? 'selected' : '' }}>{{ __('treatments.status.completed') }}</option>
                <option value="cancelled" {{ old('status', $treatment->status ?? '') == 'cancelled' ? 'selected' : '' }}>{{ __('treatments.status.cancelled') }}</option>
            </select>
            @error('status')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="description">{{ __('treatments.fields.description') }}</label>
            <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror">{{ old('description', $treatment->description ?? '') }}</textarea>
            @error('description')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
</div>
