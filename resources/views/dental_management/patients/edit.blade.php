@extends('layouts.app')

@section('title', __('patients.title_edit'))

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header bg-light border-bottom font-weight-bold">
                <h3 class="card-title"><strong><i class="fas fa-pen"></i> {{ __('patients.title_edit') . ': ' . $patient->name }}</strong></h3>
            </div>

            <div class="card-body">
                <form id="form-save" action="{{ route('dental_management.patients.update', $patient) }}" method="POST" enctype="multipart/form-data" data-parsley-validate>
                    @csrf
                    @method('PUT')

                    {{-- Personal Information --}}
                    <h4>{{ __('patients.personal_information') }}</h4>
                    <hr>
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label for="name">{{ __('patients.fields.name') }} <span class="text-danger">(*)</span></label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $patient->name) }}" required>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="lastname">{{ __('patients.fields.lastname') }} <span class="text-danger">(*)</span></label>
                            <input type="text" name="lastname" id="lastname" class="form-control" value="{{ old('lastname', $patient->lastname) }}" required>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="dni">{{ __('patients.fields.dni') }} <span class="text-danger">(*)</span></label>
                            <input type="text" name="dni" id="dni" class="form-control" value="{{ old('dni', $patient->dni) }}" required>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="email">{{ __('patients.fields.email') }} <span class="text-danger">(*)</span></label>
                            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $patient->email) }}" required>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="phone">{{ __('patients.fields.phone') }}</label>
                            <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone', $patient->phone) }}">
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="sex">{{ __('patients.fields.sex') }}</label>
                            <select name="sex" id="sex" class="form-control">
                                <option value="M" @if(old('sex', $patient->sex) == 'M') selected @endif>{{ __('patients.sex_male') }}</option>
                                <option value="F" @if(old('sex', $patient->sex) == 'F') selected @endif>{{ __('patients.sex_female') }}</option>
                                <option value="Other" @if(old('sex', $patient->sex) == 'Other') selected @endif>{{ __('patients.sex_other') }}</option>
                            </select>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="birth_date">{{ __('patients.fields.birth_date') }}</label>
                            <input type="date" name="birth_date" id="birth_date" class="form-control" value="{{ old('birth_date', $patient->birth_date) }}">
                        </div>
                        <div class="col-md-8 form-group">
                            <label for="address">{{ __('patients.fields.address') }}</label>
                            <input type="text" name="address" id="address" class="form-control" value="{{ old('address', $patient->address) }}">
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="occupation">{{ __('patients.fields.occupation') }}</label>
                            <input type="text" name="occupation" id="occupation" class="form-control" value="{{ old('occupation', $patient->occupation) }}">
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="marital_status">{{ __('patients.fields.marital_status') }}</label>
                            <select name="marital_status" id="marital_status" class="form-control">
                                <option value="Single" @if(old('marital_status', $patient->marital_status) == 'Single') selected @endif>{{ __('patients.marital_status_single') }}</option>
                                <option value="Married" @if(old('marital_status', $patient->marital_status) == 'Married') selected @endif>{{ __('patients.marital_status_married') }}</option>
                                <option value="Divorced" @if(old('marital_status', $patient->marital_status) == 'Divorced') selected @endif>{{ __('patients.marital_status_divorced') }}</option>
                                <option value="Widowed" @if(old('marital_status', $patient->marital_status) == 'Widowed') selected @endif>{{ __('patients.marital_status_widowed') }}</option>
                                <option value="Civil Union" @if(old('marital_status', $patient->marital_status) == 'Civil Union') selected @endif>{{ __('patients.marital_status_civil_union') }}</option>
                            </select>
                        </div>
                         <div class="col-md-4 form-group">
                            <label for="photo">{{ __('patients.fields.photo') }}</label>
                            <input type="file" name="photo" class="form-control">
                            @if($patient->photo)
                                <img src="{{ asset('storage/' . $patient->photo) }}" alt="Foto actual" class="img-thumbnail mt-2" width="100">
                            @endif
                        </div>
                    </div>

                    {{-- Clinical Information --}}
                    <h4 class="mt-4">{{ __('patients.clinical_information') }}</h4>
                    <hr>
                    <div class="row">
                        <div class="col-md-3 form-group">
                            <label for="blood_type">{{ __('patients.fields.blood_type') }}</label>
                            <input type="text" name="blood_type" id="blood_type" class="form-control" value="{{ old('blood_type', $patient->blood_type) }}">
                        </div>

                        {{-- En reserva: campos pertenecientes a medical_histories --}}
                        {{--
                        <div class="col-md-9 form-group">
                            <label for="allergies">{{ __('patients.fields.allergies') }}</label>
                            <textarea name="allergies" id="allergies" class="form-control">{{ old('allergies', $patient->allergies) }}</textarea>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="chronic_diseases">{{ __('patients.fields.chronic_diseases') }}</label>
                            <textarea name="chronic_diseases" id="chronic_diseases" class="form-control">{{ old('chronic_diseases', $patient->chronic_diseases) }}</textarea>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="medications">{{ __('patients.fields.medications') }}</label>
                            <textarea name="medications" id="medications" class="form-control">{{ old('medications', $patient->medications) }}</textarea>
                        </div>
                        --}}

                    </div>

                    {{-- Emergency Contact --}}
                    <h4 class="mt-4">{{ __('patients.emergency_contact') }}</h4>
                    <hr>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="emergency_contact_name">{{ __('patients.fields.emergency_contact_name') }}</label>
                            <input type="text" name="emergency_contact_name" id="emergency_contact_name" class="form-control" value="{{ old('emergency_contact_name', $patient->emergency_contact_name) }}">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="emergency_contact_phone">{{ __('patients.fields.emergency_contact_phone') }}</label>
                            <input type="text" name="emergency_contact_phone" id="emergency_contact_phone" class="form-control" value="{{ old('emergency_contact_phone', $patient->emergency_contact_phone) }}">
                        </div>
                    </div>

                    {{-- System Information --}}
                    <h4 class="mt-4">{{ __('patients.system_information') }}</h4>
                    <hr>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="tenant_name">{{ __('patients.fields.tenant_id') }}</label>
                            <input type="text" id="tenant_name" class="form-control" value="{{ $patient->tenant->name }}" disabled>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="locale_id">{{ __('patients.fields.locale_id') }} <span class="text-danger">(*)</span></label>
                            <select name="locale_id" id="locale_id" class="form-control" required>
                                @foreach($locales as $locale)
                                    <option value="{{ $locale->id }}" @if(old('locale_id', $patient->locale_id) == $locale->id) selected @endif>{{ $locale->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="is_active">{{ __('global.status') }}</label>
                            <select name="is_active" id="is_active" class="form-control">
                                <option value="1" @if(old('is_active', $patient->is_active) == 1) selected @endif>{{ __('global.active') }}</option>
                                <option value="0" @if(old('is_active', $patient->is_active) == 0) selected @endif>{{ __('global.inactive') }}</option>
                            </select>
                        </div>
                    </div>

                </form>
            </div>
            
            <div class="card-footer text-center">
                <a href="{{ route('dental_management.patients.index') }}" class="btn btn-secondary mr-2">
                    <i class="fas fa-arrow-left"></i> {{ __('global.back') }}
                </a>
                <button type="submit" form="form-save" class="btn btn-primary">
                    <i class="fas fa-save"></i> {{ __('global.update') }}
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
