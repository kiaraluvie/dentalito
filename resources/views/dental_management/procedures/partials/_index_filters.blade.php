<form action="{{ route('dental_management.procedures.index') }}" method="GET">
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="name">{{ __('procedures.fields.name') }}</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ request('name') }}">
            </div>
        </div>
        <div class="col-md-12 mt-3 text-right">
            <button type="submit" class="btn btn-primary">{{ __('global.filter') }}</button>
            <a href="{{ route('dental_management.procedures.index') }}" class="btn btn-secondary">{{ __('global.clear_filter') }}</a>
        </div>
    </div>
</form>
