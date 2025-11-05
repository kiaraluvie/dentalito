@extends('layouts.app')

@section('title', __('medical_histories.title_create'))

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-light border-bottom font-weight-bold">
                    <i class="fas fa-plus"></i> {{ __('medical_histories.title_create') }}
                </div>
                <div class="card-body">
                    <form action="{{ route('dental_management.medical_histories.store') }}" method="POST">
                        @csrf
                        @include('dental_management.medical_histories.partials._form')
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn btn-primary">{{ __('global.save') }}</button>
                                <a href="{{ route('dental_management.medical_histories.index') }}" class="btn btn-secondary">{{ __('global.cancel') }}</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
