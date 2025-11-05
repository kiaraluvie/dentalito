@extends('layouts.app')

@section('title', __('patients.title_show'))

@section('content')
<div class="row">
    {{-- Patient Header (DATOS DE PATIENTS) --}}
    <div class="col-md-12">
        <div class="card mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2 text-center">
                        <img src="{{ $patient->photo ? asset('storage/' . $patient->photo) : asset('adminlte/img/user-placeholder.png') }}" alt="{{ __('patients.fields.photo') }}" class="img-fluid rounded-circle" style="width: 120px; height: 120px; object-fit: cover;">
                    </div>
                    <div class="col-md-10">
                        <h3>{{ $patient->name }} {{ $patient->lastname }}</h3>
                        <p class="text-muted">{{ __('patients.fields.dni') }}: {{ $patient->dni }} | {{ __('patients.fields.email') }}: {{ $patient->email }} | {{ __('patients.fields.phone') }}: {{ $patient->phone }}</p>
                        <a href="{{ route('dental_management.patients.edit', $patient) }}" class="btn btn-sm btn-primary">{{ __('global.edit') }}</a>
                        <a href="{{ route('dental_management.patients.index') }}" class="btn btn-sm btn-secondary">{{ __('global.back') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Patient Details Cards (DATOS DE PATIENTS) --}}
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ __('patients.personal_information') }}</h3>
            </div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-4">{{ __('patients.fields.address') }}</dt>
                    <dd class="col-sm-8">{{ $patient->address }}</dd>

                    <dt class="col-sm-4">{{ __('patients.fields.birth_date') }}</dt>
                    <dd class="col-sm-8">{{ $patient->birth_date ? \Carbon\Carbon::parse($patient->birth_date)->format('d/m/Y') : '' }} ({{ $patient->age }} años)</dd>

                    <dt class="col-sm-4">{{ __('patients.fields.sex') }}</dt>
                    <dd class="col-sm-8">{{ $patient->sex }}</dd>

                    <dt class="col-sm-4">{{ __('patients.fields.occupation') }}</dt>
                    <dd class="col-sm-8">{{ $patient->occupation }}</dd>

                    <dt class="col-sm-4">{{ __('patients.fields.marital_status') }}</dt>
                    <dd class="col-sm-8">{{ $patient->marital_status }}</dd>
                </dl>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ __('patients.clinical_information') }}</h3>
            </div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-4">{{ __('patients.fields.blood_type') }}</dt>
                    <dd class="col-sm-8">{{ $patient->blood_type }}</dd>

                    {{-- Campos de medical_histories EN RESERVA --}}
                    {{--
                    <dt class="col-sm-4">{{ __('patients.fields.allergies') }}</dt>
                    <dd class="col-sm-8">{{ $patient->allergies }}</dd>

                    <dt class="col-sm-4">{{ __('patients.fields.chronic_diseases') }}</dt>
                    <dd class="col-sm-8">{{ $patient->chronic_diseases }}</dd>

                    <dt class="col-sm-4">{{ __('patients.fields.medications') }}</dt>
                    <dd class="col-sm-8">{{ $patient->medications }}</dd>
                    --}}

                    <dt class="col-sm-4">{{ __('patients.fields.emergency_contact_name') }}</dt>
                    <dd class="col-sm-8">{{ $patient->emergency_contact_name }} ({{ $patient->emergency_contact_phone }})</dd>
                </dl>
            </div>
        </div>
    </div>
</div>

{{-- Medical History Section EN RESERVA --}}
@if(isset($patient->medicalHistory))
<div class="col-md-12 mt-4">
    <div class="card">
        <div class="card-header bg-light border-bottom font-weight-bold d-flex justify-content-between align-items-center">
            <div>
                <i class="fas fa-notes-medical"></i> {{ __('medical_histories.title_show') }}
            </div>
            @can('medical_histories.edit')
                <a href="{{ route('dental_management.medical_histories.edit', $patient->medicalHistory->slug) }}" class="btn btn-warning btn-sm">
                <i class="fas fa-edit"></i> {{ __('global.edit') }}
            </a>
            @endcan
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>{{ __('medical_histories.fields.allergies') }}:</strong> {{ $patient->medicalHistory->allergies }}</p>
                    <p><strong>{{ __('medical_histories.fields.chronic_diseases') }}:</strong> {{ $patient->medicalHistory->chronic_diseases }}</p>
                    <p><strong>{{ __('medical_histories.fields.medications') }}:</strong> {{ $patient->medicalHistory->medications }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>{{ __('medical_histories.fields.surgical_history') }}:</strong> {{ $patient->medicalHistory->surgical_history }}</p>
                    <p><strong>{{ __('medical_histories.fields.family_history') }}:</strong> {{ $patient->medicalHistory->family_history }}</p>
                    <p><strong>{{ __('medical_histories.fields.observations') }}:</strong> {{ $patient->medicalHistory->observations }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@else
<div class="col-md-12 mt-4">
    <div class="alert alert-warning d-flex justify-content-between align-items-center mb-0">
        <span>{{ __('medical_histories.no_history_available') }}</span>
        @can('medical_histories.create')
        <a href="{{ route('dental_management.medical_histories.create', ['patient_id' => $patient->id]) }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> {{ __('global.create') }}
        </a>
        @endcan
    </div>
</div>
@endif

@endsection
