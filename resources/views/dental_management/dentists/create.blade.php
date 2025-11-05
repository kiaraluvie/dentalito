@extends('layouts.app')

@section('title', __('dentists.title_create'))

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header bg-light border-bottom font-weight-bold">
                <h3 class="card-title"><strong><i class="fas fa-plus"></i> {{ __('dentists.title_create') }}</strong></h3>
            </div>

            <div class="card-body">
                <form id="form-save" action="{{ route('dental_management.dentists.store') }}" method="POST" data-parsley-validate>
                    @csrf

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="name">{{ __('dentists.fields.name') }} <span class="text-danger">(*)</span></label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="email">{{ __('dentists.fields.email') }} <span class="text-danger">(*)</span></label>
                            <input type="email" name="email" id="email" class="form-control" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="password">{{ __('dentists.fields.password') }} <span class="text-danger">(*)</span></label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="specialties">{{ __('dentists.fields.specialties') }} <span class="text-danger">(*)</span></label>
                            <select name="specialties[]" id="specialties" class="form-control select2" data-placeholder="{{ __('global.search_by_name') }}" multiple required>
                                @foreach($specialties as $specialty)
                                    <option value="{{ $specialty->id }}">{{ $specialty->name }}</option>
                                @endforeach
                            </select>
                            <small class="text-muted">{{ __('dentists.hints.specialties') }}</small>
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="license_number">{{ __('dentists.fields.license_number') }} <span class="text-danger">(*)</span></label>
                            <input type="text" name="license_number" id="license_number" class="form-control" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="phone">{{ __('dentists.fields.phone') }}</label>
                            <input type="text" name="phone" id="phone" class="form-control">
                        </div>
                    </div>

                </form>
            </div>
            
            <div class="card-footer text-center">
                <a href="{{ route('dental_management.dentists.index') }}" class="btn btn-secondary mr-2">
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

@section('scripts')
<script>
    $(function () {
        $('#specialties').select2({
            theme: 'bootstrap4',
            width: '100%'
        });
    });
</script>
@endsection
