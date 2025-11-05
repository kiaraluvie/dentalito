<form action="{{ route('dental_management.dentists.index') }}" method="GET" class="mb-3">
  <div class="row">
    <div class="col-md-4">
      <label for="name" class="form-label">{{ __('dentists.fields.name') }}</label>
      <input type="text" name="name" id="name" class="form-control" placeholder="{{ __('dentists.search_by_name') }}"
             value="{{ request('name') }}">
    </div>

    <div class="col-md-4">
      <label for="email" class="form-label">{{ __('dentists.fields.email') }}</label>
      <input type="email" name="email" id="email" class="form-control" placeholder="{{ __('dentists.search_by_email') }}"
             value="{{ request('email') }}">
    </div>

    <div class="col-md-4">
      <label for="specialty" class="form-label">{{ __('dentists.fields.specialty') }}</label>
      <input type="text" name="specialty" id="specialty" class="form-control" placeholder="{{ __('dentists.search_by_specialty') }}"
             value="{{ request('specialty') }}">
    </div>
  </div>

  <div class="row pt-4">
    <div class="col-md-12 text-center">
      <button type="submit" class="btn btn-primary me-2">
        <i class="fas fa-search"></i> {{ __('global.search') }}
      </button>
      <a href="{{ route('dental_management.dentists.index') }}" class="btn btn-secondary">
        <i class="fas fa-brush"></i> {{ __('global.clear') }}
      </a>
    </div>
  </div>
</form>
