<form action="{{ route('dental_management.specialties.index') }}" method="GET" class="mb-3">
  <div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="name">{{ __('specialty.fields.name') }}</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ request('name') }}" placeholder="{{ __('global.search_by_name') }}">
        </div>
    </div>
  </div>

  <div class="row pt-4">
    <div class="col-md-12 text-center">
      <button type="submit" class="btn btn-primary me-2">
        <i class="fas fa-search"></i> {{ __('global.search') }}
      </button>
      <a href="{{ route('dental_management.specialties.index') }}" class="btn btn-secondary">
        <i class="fas fa-brush"></i> {{ __('global.clear') }}
      </a>
    </div>
  </div>
</form>
