@extends('layouts.app')

@section('title', __('treatments.title_edit'))

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-light border-bottom font-weight-bold">
                    <i class="fas fa-pen"></i> {{ __('treatments.title_edit') }}
                </div>
                <div class="card-body">
                    <form action="{{ route('dental_management.treatments.update', $treatment) }}" method="POST">
                        @csrf
                        @method('PUT')
                        @include('dental_management.treatments.partials._form')
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn btn-primary">{{ __('global.save') }}</button>
                                <a href="{{ route('dental_management.treatments.index') }}" class="btn btn-secondary">{{ __('global.cancel') }}</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
