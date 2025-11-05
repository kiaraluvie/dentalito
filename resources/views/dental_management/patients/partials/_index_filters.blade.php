<form action="{{ route('dental_management.patients.index') }}" method="GET" class="mb-3">
  <div class="row">
    <div class="col-md-4">
      <label for="name" class="form-label">{{ __('patients.fields.name') }}</label>
      <input type="text" name="name" id="name" class="form-control" placeholder="{{ __('patients.search_by_name') }}"
             value="{{ request('name') }}">
    </div>

    <div class="col-md-4">
      <label for="lastname" class="form-label">{{ __('patients.fields.lastname') }}</label>
      <input type="text" name="lastname" id="lastname" class="form-control" placeholder="{{ __('patients.search_by_lastname') }}"
             value="{{ request('lastname') }}">
    </div>

    <div class="col-md-4">
      <label for="dni" class="form-label">{{ __('patients.fields.dni') }}</label>
      <input type="text" name="dni" id="dni" class="form-control" placeholder="{{ __('patients.search_by_dni') }}"
             value="{{ request('dni') }}">
    </div>
  </div>

  <div class="row pt-4">
    <div class="col-md-12 text-center">
      <button type="submit" class="btn btn-primary me-2">
        <i class="fas fa-search"></i> {{ __('global.search') }}
      </button>
      <a href="{{ route('dental_management.patients.index') }}" class="btn btn-secondary">
        <i class="fas fa-brush"></i> {{ __('global.clear') }}
      </a>
    </div>
  </div>
</form>
