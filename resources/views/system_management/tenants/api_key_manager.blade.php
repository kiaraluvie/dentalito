@extends('layouts.app')

@section('title', __('tenants.api_key_manager_title'))
@section('title_navbar', __('tenants.singular'))

@section('content')
{{-- Display New API Key Modal --}}
@if (session('api_key'))
<div class="row">
    <div class="col-lg-12">
        <div class="alert alert-success">
            <h5><i class="icon fas fa-check"></i> {{ __('tenants.api_key_generated_title') }}</h5>
            <p>{{ __('tenants.api_key_generated_message') }}</p>
            <div class="input-group">
                <input type="text" id="new-api-key" class="form-control" readonly value="{{ session('api_key') }}">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button" onclick="copyToClipboard('#new-api-key')">{{ __('global.copy') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

{{-- API Key Management Card --}}
<div class="row">
    <div class="col-lg-12">
        <div class="card card-warning rounded">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-key"></i> {{ __('tenants.api_key_management_title') }}
                </h3>
                 <div class="card-tools">
                    <a href="{{ route('system_management.tenants.index') }}" class="btn btn-tool">
                      <i class="fas fa-times"></i>
                    </a>
                </div>
            </div>
            <div class="card-body">
                <p>{{ __('tenants.api_key_explanation') }}</p>
                <label>{{ __('tenants.current_api_key') }}</label>
                <div class="input-group">
                    <input type="text" id="current-api-key" class="form-control" readonly value="{{ $tenant->api_token ?? __('tenants.no_api_key') }}">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button" onclick="copyToClipboard('#current-api-key')" @if(!$tenant->api_token) disabled @endif>{{ __('global.copy') }}</button>
                    </div>
                </div>
            </div>
            <div class="card-footer text-center">
                <form action="{{ route('system_management.tenants.generate_api_key', $tenant->slug) }}" method="POST" onsubmit="return confirm('{{ __('tenants.generate_api_key_confirm') }}')">
                    @csrf
                    <button type="submit" class="btn btn-warning">
                        <i class="fas fa-sync-alt"></i> {{ __('tenants.generate_new_key') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function copyToClipboard(elementId) {
        var copyText = document.querySelector(elementId);
        copyText.select();
        copyText.setSelectionRange(0, 99999); // For mobile devices
        document.execCommand("copy");
        alert('{{ __("global.copied_to_clipboard") }}');
    }
</script>
@endpush
