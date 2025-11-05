@extends('layouts.app')

@section('title', __('medical_histories.title_show'))

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-light border-bottom font-weight-bold">
                    <i class="fas fa-eye"></i> {{ __('medical_histories.title_show') }}
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <p><strong>{{ __('medical_histories.fields.patient') }}:</strong> {{ $medicalHistory->patient->name }} {{ $medicalHistory->patient->lastname }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>{{ __('medical_histories.fields.allergies') }}:</strong> {{ $medicalHistory->allergies }}</p>
                            <p><strong>{{ __('medical_histories.fields.chronic_diseases') }}:</strong> {{ $medicalHistory->chronic_diseases }}</p>
                            <p><strong>{{ __('medical_histories.fields.medications') }}:</strong> {{ $medicalHistory->medications }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>{{ __('medical_histories.fields.surgical_history') }}:</strong> {{ $medicalHistory->surgical_history }}</p>
                            <p><strong>{{ __('medical_histories.fields.family_history') }}:</strong> {{ $medicalHistory->family_history }}</p>
                            <p><strong>{{ __('medical_histories.fields.observations') }}:</strong> {{ $medicalHistory->observations }}</p>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <a href="{{ route('dental_management.medical_histories.index') }}" class="btn btn-secondary">{{ __('global.back') }}</a>
                </div>
            </div>
        </div>
    </div>
@endsection
