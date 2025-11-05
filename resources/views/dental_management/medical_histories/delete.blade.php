@extends('layouts.app')

@section('title', __('medical_histories.title_delete'))

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-light border-bottom font-weight-bold">
                    <i class="fas fa-trash"></i> {{ __('medical_histories.title_delete') }}
                </div>
                <div class="card-body">
                    <p>{{ __('medical_histories.delete_confirm', ['name' => $medicalHistory->patient->name . ' ' . $medicalHistory->patient->lastname]) }}</p>
                    <form action="{{ route('dental_management.medical_histories.deleteSave', $medicalHistory) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="form-group">
                            <label for="deleted_description">{{ __('global.delete_reason') }}</label>
                            <textarea name="deleted_description" id="deleted_description" class="form-control @error('deleted_description') is-invalid @enderror"></textarea>
                            @error('deleted_description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-danger">{{ __('global.delete') }}</button>
                            <a href="{{ route('dental_management.medical_histories.index') }}" class="btn btn-secondary">{{ __('global.cancel') }}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
