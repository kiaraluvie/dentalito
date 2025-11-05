@extends('layouts.app')

@section('title', __('patients.title_create'))

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header bg-light border-bottom font-weight-bold">
                <h3 class="card-title"><strong><i class="fas fa-plus"></i> {{ __('patients.title_create') }}</strong></h3>
            </div>

            <div class="card-body">
                <form id="form-save" action="{{ route('dental_management.patients.store') }}" method="POST" enctype="multipart/form-data" data-parsley-validate>
                    @csrf

                    {{-- Personal Information --}}
                    <h4>{{ __('patients.personal_information') }}</h4>
                    <hr>
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label for="name">{{ __('patients.fields.name') }} <span class="text-danger">(*)</span></label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="lastname">{{ __('patients.fields.lastname') }} <span class="text-danger">(*)</span></label>
                            <input type="text" name="lastname" id="lastname" class="form-control" required>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="dni">{{ __('patients.fields.dni') }} <span class="text-danger">(*)</span></label>
                            <input type="text" name="dni" id="dni" class="form-control" required>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="email">{{ __('patients.fields.email') }} <span class="text-danger">(*)</span></label>
                            <input type="email" name="email" id="email" class="form-control" required>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="phone">{{ __('patients.fields.phone') }}</label>
                            <input type="text" name="phone" id="phone" class="form-control">
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="sex">{{ __('patients.fields.sex') }}</label>
                            <select name="sex" id="sex" class="form-control">
                                <option value="M">{{ __('patients.sex_male') }}</option>
                                <option value="F">{{ __('patients.sex_female') }}</option>
                                <option value="Other">{{ __('patients.sex_other') }}</option>
                            </select>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="birth_date">{{ __('patients.fields.birth_date') }}</label>
                            <input type="date" name="birth_date" id="birth_date" class="form-control">
                        </div>
                        <div class="col-md-8 form-group">
                            <label for="address">{{ __('patients.fields.address') }}</label>
                            <input type="text" name="address" id="address" class="form-control">
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="occupation">{{ __('patients.fields.occupation') }}</label>
                            <input type="text" name="occupation" id="occupation" class="form-control">
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="marital_status">{{ __('patients.fields.marital_status') }}</label>
                            <select name="marital_status" id="marital_status" class="form-control">
                                <option value="Single">{{ __('patients.marital_status_single') }}</option>
                                <option value="Married">{{ __('patients.marital_status_married') }}</option>
                                <option value="Divorced">{{ __('patients.marital_status_divorced') }}</option>
                                <option value="Widowed">{{ __('patients.marital_status_widowed') }}</option>
                                <option value="Civil Union">{{ __('patients.marital_status_civil_union') }}</option>
                            </select>
                        </div>
                         <div class="col-md-4 form-group">
                            <label for="photo">{{ __('patients.fields.photo') }}</label>
                            <input type="file" name="photo" class="form-control">
                        </div>
                    </div>

                    {{-- Clinical Information --}}
                    <h4 class="mt-4">{{ __('patients.clinical_information') }}</h4>
                    <hr>
                    <div class="row">
                        <div class="col-md-3 form-group">
                            <label for="blood_type">{{ __('patients.fields.blood_type') }}</label>
                            <input type="text" name="blood_type" id="blood_type" class="form-control">
                        </div>
                        <div class="col-md-9 form-group">
                            <label for="allergies">{{ __('patients.fields.allergies') }}</label>
                            <textarea name="allergies" id="allergies" class="form-control"></textarea>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="chronic_diseases">{{ __('patients.fields.chronic_diseases') }}</label>
                            <textarea name="chronic_diseases" id="chronic_diseases" class="form-control"></textarea>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="medications">{{ __('patients.fields.medications') }}</label>
                            <textarea name="medications" id="medications" class="form-control"></textarea>
                        </div>
                    </div>

                    {{-- Emergency Contact --}}
                    <h4 class="mt-4">{{ __('patients.emergency_contact') }}</h4>
                    <hr>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="emergency_contact_name">{{ __('patients.fields.emergency_contact_name') }}</label>
                            <input type="text" name="emergency_contact_name" id="emergency_contact_name" class="form-control">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="emergency_contact_phone">{{ __('patients.fields.emergency_contact_phone') }}</label>
                            <input type="text" name="emergency_contact_phone" id="emergency_contact_phone" class="form-control">
                        </div>
                    </div>

                     {{-- System Information --}}
                    <h4 class="mt-4">{{ __('patients.system_information') }}</h4>
                    <hr>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="tenant_name">{{ __('patients.fields.tenant_id') }}</label>
                            <input type="text" id="tenant_name" class="form-control" value="{{ $tenant->name }}" disabled>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="locale_id">{{ __('patients.fields.locale_id') }} <span class="text-danger">(*)</span></label>
                            <select name="locale_id" id="locale_id" class="form-control" required>
                                @foreach($locales as $locale)
                                    <option value="{{ $locale->id }}">{{ $locale->name }}</option>
                                @endforeach
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
                    <i class="fas fa-save"></i> {{ __('global.save') }}
                </button>
            </div>
        </div>
    </div>
</div>
@endsection