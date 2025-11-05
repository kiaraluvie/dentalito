@extends('layouts.app')

@section('title', __('dentists.title_show'))

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ __('dentists.title_show') }}</h3>
            </div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-3">{{ __('dentists.fields.name') }}</dt>
                    <dd class="col-sm-9">{{ $dentist->user->name }}</dd>

                    <dt class="col-sm-3">{{ __('dentists.fields.email') }}</dt>
                    <dd class="col-sm-9">{{ $dentist->user->email }}</dd>

                    <dt class="col-sm-3">{{ __('dentists.fields.specialty') }}</dt>
                    <dd class="col-sm-9">{{ $dentist->specialty }}</dd>

                    <dt class="col-sm-3">{{ __('dentists.fields.license_number') }}</dt>
                    <dd class="col-sm-9">{{ $dentist->license_number }}</dd>

                    <dt class="col-sm-3">{{ __('dentists.fields.phone') }}</dt>
                    <dd class="col-sm-9">{{ $dentist->phone }}</dd>

                    <dt class="col-sm-3">{{ __('dentists.fields.is_active') }}</dt>
                    <dd class="col-sm-9">{!! $dentist->is_active ? '<span class="badge badge-success">Activo</span>' : '<span class="badge badge-danger">Inactivo</span>' !!}</dd>
                </dl>
            </div>
            <div class="card-footer text-center">
                <a href="{{ route('dental_management.dentists.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> {{ __('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
