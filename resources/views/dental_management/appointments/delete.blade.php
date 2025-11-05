@extends('layouts.app')

@section('title', __('global.delete'))

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header bg-danger text-white">
                <h3 class="card-title"><strong><i class="fas fa-trash"></i> {{ __('global.delete') }}</strong></h3>
            </div>
            <div class="card-body">
                <p>{{ __('global.are_you_sure') }}</p>
                <p class="text-danger">{{ __('global.irreversible_action') }}</p>
                <form id="form-delete" action="{{ route('dental_management.appointments.deleteSave', $appointment) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="form-group">
                        <label for="deleted_description">{{ __('global.delete_description') }}</label>
                        <textarea name="deleted_description" id="deleted_description" class="form-control" rows="3"></textarea>
                    </div>
                </form>
            </div>
            <div class="card-footer text-center">
                <a href="{{ route('dental_management.appointments.index') }}" class="btn btn-secondary mr-2">
                    <i class="fas fa-arrow-left"></i> {{ __('global.cancel') }}
                </a>
                <button type="submit" form="form-delete" class="btn btn-danger">
                    <i class="fas fa-trash"></i> {{ __('global.yes_delete') }}
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
