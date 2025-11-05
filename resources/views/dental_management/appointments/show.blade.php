@extends('layouts.app')

@section('title', __('appointments.title_show'))

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ __('appointments.title_show') }}</h3>
            </div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-3">{{ __('appointments.fields.patient') }}</dt>
                    <dd class="col-sm-9">{{ $appointment->patient->name }} {{ $appointment->patient->lastname }}</dd>

                    <dt class="col-sm-3">{{ __('appointments.fields.dentist') }}</dt>
                    <dd class="col-sm-9">{{ $appointment->dentist->user->name }}</dd>

                    <dt class="col-sm-3">{{ __('appointments.fields.appointment_date') }}</dt>
                    <dd class="col-sm-9">{{ $appointment->appointment_date }}</dd>

                    <dt class="col-sm-3">{{ __('appointments.fields.start_time') }}</dt>
                    <dd class="col-sm-9">{{ $appointment->start_time }}</dd>

                    <dt class="col-sm-3">{{ __('appointments.fields.end_time') }}</dt>
                    <dd class="col-sm-9">{{ $appointment->end_time }}</dd>

                    <dt class="col-sm-3">{{ __('appointments.fields.reason') }}</dt>
                    <dd class="col-sm-9">{{ $appointment->reason }}</dd>

                    <dt class="col-sm-3">{{ __('appointments.fields.status') }}</dt>
                    <dd class="col-sm-9">{{ $appointment->status }}</dd>

                    <dt class="col-sm-3">{{ __('appointments.fields.notes') }}</dt>
                    <dd class="col-sm-9">{{ $appointment->notes }}</dd>
                </dl>
            </div>
            <div class="card-footer text-center">
                <a href="{{ route('dental_management.appointments.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> {{ __('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
