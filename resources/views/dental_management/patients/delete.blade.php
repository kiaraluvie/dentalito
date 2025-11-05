@extends('layouts.app')

@section('title', __('global.delete'))

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header bg-danger text-white">
                <h3 class="card-title"><strong><i class="fas fa-trash"></i> {{ __('global.delete') }}: {{ $patient->name }}</strong></h3>
            </div>
            <div class="card-body">
                <p>{{ __('global.are_you_sure') }}</p>
                <p class="text-danger">{{ __('global.irreversible_action') }}</p>
            </div>
            <div class="card-footer text-center">
                <form action="{{ route('dental_management.patients.destroy', $patient) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <a href="{{ route('dental_management.patients.index') }}" class="btn btn-secondary mr-2">
                        <i class="fas fa-arrow-left"></i> {{ __('global.cancel') }}
                    </a>
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash"></i> {{ __('global.yes_delete') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
