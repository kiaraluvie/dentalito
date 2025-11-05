@extends('layouts.app')

@section('title', __('specialty.title_edit'))

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header bg-light border-bottom font-weight-bold">
                <h3 class="card-title"><strong><i class="fas fa-pen"></i> {{ __('specialty.title_edit') }}</strong></h3>
            </div>

            <div class="card-body">
                <form id="form-save" action="{{ route('dental_management.specialties.update', $specialty) }}" method="POST" data-parsley-validate>
                    @csrf
                    @method('PUT')

                    @include('dental_management.especialties.partials._form')

                </form>
            </div>
            
            <div class="card-footer text-center">
                <a href="{{ route('dental_management.specialties.index') }}" class="btn btn-secondary mr-2">
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
