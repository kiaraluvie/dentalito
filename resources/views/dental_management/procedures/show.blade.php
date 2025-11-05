@extends('layouts.app')

@section('title', __('procedures.title_show'))

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-light border-bottom font-weight-bold">
                    <i class="fas fa-eye"></i> {{ __('procedures.title_show') }}
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>{{ __('procedures.fields.name') }}:</strong> {{ $procedure->name }}</p>
                            <p><strong>{{ __('procedures.fields.price') }}:</strong> {{ $procedure->price }}</p>
                            <p><strong>{{ __('procedures.fields.is_active') }}:</strong>
                                @if ($procedure->is_active)
                                    <span class="badge badge-success">{{ __('global.active') }}</span>
                                @else
                                    <span class="badge badge-danger">{{ __('global.inactive') }}</span>
                                @endif
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>{{ __('procedures.fields.description') }}:</strong> {{ $procedure->description }}</p>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <a href="{{ route('dental_management.procedures.index') }}" class="btn btn-secondary">{{ __('global.back') }}</a>
                </div>
            </div>
        </div>
    </div>
@endsection
