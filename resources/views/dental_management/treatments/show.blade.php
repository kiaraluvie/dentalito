@extends('layouts.app')

@section('title', __('treatments.title_show'))

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-light border-bottom font-weight-bold">
                    <i class="fas fa-eye"></i> {{ __('treatments.title_show') }}
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>{{ __('treatments.fields.patient') }}:</strong> {{ $treatment->patient->name }} {{ $treatment->patient->lastname }}</p>
                            <p><strong>{{ __('treatments.fields.dentist') }}:</strong> {{ $treatment->dentist->user->name }}</p>
                            <p><strong>{{ __('treatments.fields.procedure') }}:</strong> {{ $treatment->procedure->name }}</p>
                            <p><strong>{{ __('treatments.fields.date') }}:</strong> {{ $treatment->date }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>{{ __('treatments.fields.price') }}:</strong> {{ $treatment->price }}</p>
                            <p><strong>{{ __('treatments.fields.status') }}:</strong>
                                <span class="badge badge-{{ __('treatments.status_colors.' . $treatment->status) }}">
                                    {{ __('treatments.status.' . $treatment->status) }}
                                </span>
                            </p>
                            <p><strong>{{ __('treatments.fields.description') }}:</strong> {{ $treatment->description }}</p>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <a href="{{ route('dental_management.treatments.index') }}" class="btn btn-secondary">{{ __('global.back') }}</a>
                </div>
            </div>
        </div>
    </div>
@endsection
