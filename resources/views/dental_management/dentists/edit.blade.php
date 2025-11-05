@extends('layouts.app')

@section('title', __('dentists.title_edit'))

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header bg-light border-bottom font-weight-bold">
                <h3 class="card-title"><strong><i class="fas fa-pen"></i> {{ __('dentists.title_edit') }}</strong></h3>
            </div>

            <div class="card-body">
                <form id="form-save" action="{{ route('dental_management.dentists.update', $dentist) }}" method="POST" data-parsley-validate>
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="name">{{ __('dentists.fields.name') }} <span class="text-danger">(*)</span></label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $dentist->user->name) }}" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="email">{{ __('dentists.fields.email') }} <span class="text-danger">(*)</span></label>
                            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $dentist->user->email) }}" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="password">{{ __('dentists.fields.password') }}</label>
                            <input type="password" name="password" id="password" class="form-control">
                            <small class="text-muted">Dejar en blanco para no cambiar la contraseña.</small>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="specialties">{{ __('dentists.fields.specialties') }} <span class="text-danger">(*)</span></label>
                            <select name="specialties[]" id="specialties" class="form-control select2" data-placeholder="{{ __('global.search_by_name') }}" multiple required>
                                @foreach($specialties as $specialty)
                                    <option value="{{ $specialty->id }}"
                                        {{ in_array($specialty->id, old('specialties', $dentist->specialties->pluck('id')->toArray())) ? 'selected' : '' }}>
                                        {{ $specialty->name }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="text-muted">{{ __('dentists.hints.specialties') }}</small>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="license_number">{{ __('dentists.fields.license_number') }} <span class="text-danger">(*)</span></label>
                            <input type="text" name="license_number" id="license_number" class="form-control" value="{{ old('license_number', $dentist->license_number) }}" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="phone">{{ __('dentists.fields.phone') }}</label>
                            <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone', $dentist->phone) }}">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="is_active">{{ __('dentists.fields.is_active') }}</label>
                            <select name="is_active" id="is_active" class="form-control">
                                <option value="1" @if(old('is_active', $dentist->is_active) == 1) selected @endif>{{ __('global.active') }}</option>
                                <option value="0" @if(old('is_active', $dentist->is_active) == 0) selected @endif>{{ __('global.inactive') }}</option>
                            </select>
                        </div>
                    </div>

                </form>
            </div>
            
            <div class="card-footer text-center">
                <a href="{{ route('dental_management.dentists.index') }}" class="btn btn-secondary mr-2">
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
