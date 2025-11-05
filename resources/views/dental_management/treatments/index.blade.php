@extends('layouts.app')

@section('title', __('treatments.title_index'))

@section('content')
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-header bg-light border-bottom font-weight-bold">
          <i class="fas fa-filter"></i> {{ __('global.card_title_filter') }}
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Minimizar">
              <i class="fas fa-minus"></i>
            </button>
          </div>
        </div>    
        <div class="card-body">
          @include('dental_management.treatments.partials._index_filters')
        </div>
      </div>
    </div>
  </div>    

  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-header bg-light border-bottom font-weight-bold">
            <i class="fas fa-table"></i> {{ __('global.card_title_result') }}: 
            @if ($treatments->total() > 0)<strong>{{ $treatments->total() }}</strong>@else 0 @endif
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Minimizar">
              <i class="fas fa-minus"></i>
            </button>
          </div>
        </div>    
        <div class="card-body">
          <div class="row">
            <div class="col-12 text-right pt-0 pb-1">
              @can('treatments.create')
              <a class="btn btn-primary" href="{{ route('dental_management.treatments.create') }}">
                <i class="fas fa-plus"></i> {{ __('global.create') }}
              </a>
              @endcan
            </div>
          </div>
          <div class="table-responsive">
            @include('dental_management.treatments.partials._index_results')
          </div>
          @if ($treatments->total() > 0)
          <div class="row">
            <div class="col-12 pt-2 pb-0">
              {{ $treatments->links() }}
            </div>
          </div>
          @endif
        </div>
      </div>
    </div>
  </div>    
@endsection
