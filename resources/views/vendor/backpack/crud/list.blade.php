@extends(backpack_view('blank'))

@php
  $defaultBreadcrumbs = [
    trans('backpack::crud.admin') => url(config('backpack.base.route_prefix'), 'dashboard'),
    $crud->entity_name_plural => url($crud->route),
    trans('backpack::crud.list') => false,
  ];

  // if breadcrumbs aren't defined in the CrudController, use the default breadcrumbs
  $breadcrumbs = $breadcrumbs ?? $defaultBreadcrumbs;
  $isSubmitCasePath = Request::segment(2) == config('const.submitcase_route_path');
  $currentUrl = Request::url();
@endphp

@section('header')
  <div class="container-fluid">
    <h2>
      <span class="text-capitalize">{!! $crud->getHeading() ?? $crud->entity_name_plural !!}</span>
      <small id="datatable_info_stack">{!! $crud->getSubheading() ?? '' !!}</small>
    </h2>
  </div>
@endsection

@section('content')
  <!-- Default box -->
  <div class="row">

    <!-- THE ACTUAL CONTENT -->
    <div class="{{ $crud->getListContentClass() }}">

        <div class="row mb-0 mb-2">
          <div class="col-sm-6">
            @if ( $crud->buttons()->where('stack', 'top')->count() ||  $crud->exportButtons())
              <div class="hidden-print d-inline {{ $crud->hasAccess('create')?'with-border':'' }}">

                @include('crud::inc.button_stack', ['stack' => 'top'])

              </div>
            @endif
            @include('partials.filters.index')
          </div>
          <div class="col-sm-6">
            <div id="datatable_search_stack" class="mt-sm-0 mt-2"></div>
          </div>
            @include('partials.tabbar_on_list.tab')
        </div>
        

        {{-- Filter Index --}}
        {{-- Backpack List Filters --}}
        {{-- @if ($crud->filtersEnabled())
          @include('crud::inc.filters_navbar')
        @endif --}}

        <table id="crudTable" class="property-table-sticky bg-white table table-striped table-hover nowrap rounded shadow-xs border-xs mt-2" cellspacing="0">
            <thead>
              <tr>
                {{-- Table columns --}}
                @foreach ($crud->columns() as $column)
                  <th
                    data-orderable="{{ var_export($column['orderable'], true) }}"
                    data-priority="{{ $column['priority'] }}"
                     {{--

                        data-visible-in-table => if developer forced field in table with 'visibleInTable => true'
                        data-visible => regular visibility of the field
                        data-can-be-visible-in-table => prevents the column to be loaded into the table (export-only)
                        data-visible-in-modal => if column apears on responsive modal
                        data-visible-in-export => if this field is exportable
                        data-force-export => force export even if field are hidden

                    --}}

                    {{-- If it is an export field only, we are done. --}}
                    @if(isset($column['exportOnlyField']) && $column['exportOnlyField'] === true)
                      data-visible="false"
                      data-visible-in-table="false"
                      data-can-be-visible-in-table="false"
                      data-visible-in-modal="false"
                      data-visible-in-export="true"
                      data-force-export="true"

                    @else

                      data-visible-in-table="{{var_export($column['visibleInTable'] ?? false)}}"
                      data-visible="{{var_export($column['visibleInTable'] ?? true)}}"
                      data-can-be-visible-in-table="true"
                      data-visible-in-modal="{{var_export($column['visibleInModal'] ?? true)}}"
                      @if(isset($column['visibleInExport']))
                        @if($column['visibleInExport'] === false)
                          data-visible-in-export="false"
                          data-force-export="false"
                        @else
                          data-visible-in-export="true"
                          data-force-export="true"
                        @endif
                      @else
                        data-visible-in-export="true"
                        data-force-export="false"
                      @endif
                    @endif
                  >
                    {!! $column['label'] !!}
                  </th>
                @endforeach

                @if ( $crud->buttons()->where('stack', 'line')->count() )
                  <th data-orderable="false" data-priority="{{ $crud->getActionsColumnPriority() }}" data-visible-in-export="false">{{ trans('backpack::crud.actions') }}</th>
                @endif
              </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
              <tr>
                {{-- Table columns --}}
                @foreach ($crud->columns() as $column)
                  <th>{!! $column['label'] !!}</th>
                @endforeach

                @if ( $crud->buttons()->where('stack', 'line')->count() )
                  <th>{{ trans('backpack::crud.actions') }}</th>
                @endif
              </tr>
            </tfoot>
          </table>

          @if ( $crud->buttons()->where('stack', 'bottom')->count() )
          <div id="bottom_buttons" class="hidden-print">
            @include('crud::inc.button_stack', ['stack' => 'bottom'])

            <div id="datatable_button_stack" class="float-right text-right hidden-xs"></div>
          </div>
          @endif

    </div>

  </div>

@endsection

@section('after_styles')
    @php
        $MatchURL = config('settings.all_crud_list_scrollbar_option');
        $arr = explode(',',$MatchURL);
    @endphp

    @if(in_array(\Str::lower(request()->segment(2)), $arr))
        <style>
           .property-table-sticky tr th:last-child,
            tr td:last-child {
                position: sticky!important;
                right: 0;
                background-color: #F9FBFD!important;
            }
        </style>
    @endif
    <style>
        .row-custom {
            padding: 0 0.7rem 0 0.7rem;
        }
        .la-custom {
            font-size: 28px;
        }
        .text-custom {
            color: #1b2b4d;
            display: block;
            font-size: 22px;
        }
        .number-custom {
            color: #000;
            font-size: 16px;
        }
        .card-custom {
            border: 1px solid #F1ECEC;
            border-radius: 0.25rem !important;
        }
        .card-custom:hover,
        .card-custom:focus {
            text-decoration: none;
            background-color: rgba(255, 255, 255, 0.5);
        }
        .card-custom.active {
            background-color: lightskyblue;
        }
        .card-custom .card-body {
            padding-top: 0.4rem;
            padding-bottom: 0.4rem;
        }
        .bg-circle {
            color: #fff;
            border-radius: 50%;
            padding: 9px;
            width: 50px;
            height: 50px;
        }
        .bg-all {
            background-color: #786fa6;
        }
        .bg-late {
            background-color: #e67e22;
        }
        .bg-primary {
            background-color: #6ca1e9;
        }
        .bg-danger {
            background-color: #df4759;
        }
        .bg-save-draft {
            background-color: #6ca1e9;
        }
        .bg-info {
            background-color: #00c6b7;
        }
        .bg-warning {
            background-color: #f2cf5b;
        }
        .bg-progress {
            background-color: #079992;
        }
        .bg-transaction {
            background-color: #2ba745;
        }
    </style>
  <link rel="stylesheet" type="text/css" href="{{ asset('packages/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('packages/datatables.net-fixedheader-bs4/css/fixedHeader.bootstrap4.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('packages/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}">

  <link rel="stylesheet" href="{{ asset('packages/backpack/crud/css/crud.css') }}">
  <link rel="stylesheet" href="{{ asset('packages/backpack/crud/css/form.css') }}">
  <link rel="stylesheet" href="{{ asset('packages/backpack/crud/css/list.css') }}">

  @stack('crud_list_styles')
@endsection
@php
    $caseStatus = Request::has('case_status') ? Request::get('case_status') : (Request::has('caseStatus') ? Request::get('caseStatus') : '');
@endphp




@section('after_scripts')
  @include('crud::inc.datatables_logic')
  <script src="{{ asset('packages/backpack/crud/js/crud.js') }}"></script>
  <script src="{{ asset('packages/backpack/crud/js/form.js') }}"></script>
  <script src="{{ asset('packages/backpack/crud/js/list.js') }}"></script>

  <!-- CRUD LIST CONTENT - crud_list_scripts stack -->
  @stack('crud_list_scripts')
 
@endsection
