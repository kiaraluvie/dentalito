@extends('layouts.app')

@section('title', __('appointments.title_create'))

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header bg-light border-bottom font-weight-bold">
                <h3 class="card-title"><strong><i class="fas fa-plus"></i> {{ __('appointments.title_create') }}</strong></h3>
            </div>

            <div class="card-body">
                <form id="form-save" action="{{ route('dental_management.appointments.store') }}" method="POST" data-parsley-validate>
                    @csrf

                    @include('dental_management.appointments.partials._form')

                </form>
            </div>
            
            <div class="card-footer text-center">
                <a href="{{ route('dental_management.appointments.index') }}" class="btn btn-secondary mr-2">
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
