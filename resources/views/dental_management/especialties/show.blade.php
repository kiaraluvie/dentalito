@extends('layouts.app')

@section('title', __('specialty.title_show'))

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ __('specialty.title_show') }}</h3>
            </div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-3">{{ __('specialty.fields.name') }}</dt>
                    <dd class="col-sm-9">{{ $specialty->name }}</dd>

                    <dt class="col-sm-3">{{ __('specialty.fields.description') }}</dt>
                    <dd class="col-sm-9">{{ $specialty->description }}</dd>
                </dl>
            </div>
            <div class="card-footer text-center">
                <a href="{{ route('dental_management.specialties.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> {{ __('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
