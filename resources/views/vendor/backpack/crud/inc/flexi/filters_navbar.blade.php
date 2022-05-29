<form method="get" id="customer-filter-form" class="p-3">
        <nav class="navbar navbar-expand-lg navbar-filters px-0">

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bp-filters-navbar">
            <ul class="nav navbar-nav">
                <!-- THE ACTUAL FILTERS -->
                @foreach ($crud->filters() as $filter)
                    @if (Request::segment(2) == 'submitcase' && ($filter->name === 'caseStatus' || $filter->name === 'case_status'))
                        @continue
                    @endif
                    @include($filter->getViewWithNamespace())
                @endforeach
                {{-- <li class="nav-item"><a href="{{ Request::url() }}" id="remove_filters_button" class="nav-link {{ count(Request::input()) != 0 ? '' : 'invisible' }}"><i class="la la-eraser"></i> {{ trans('backpack::crud.remove_filters') }}</a></li> --}}
                <li class="nav-item cursor-pointer"><a id="remove_filters_button" class="btn btn-primary text-white rounded {{ count(Request::input()) != 0 ? '' : 'invisible' }}"><i class="la la-eraser"></i> {{ trans('backpack::crud.remove_filters') }}</a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</form>

@push('after_scripts')
    <style>
        .cursor-pointer {
            cursor: pointer;
        }
    </style>
@endpush

@push('after_scripts')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/URI.js/1.18.2/URI.min.js" type="text/javascript"></script>
    <script>
        rmInitializeFieldsWithJavascript('#customer-filter-form');
        function clearLoading() {
          $('#loader').css('display', 'none');
        }

        function mySearchSubmit() {
            if ($("#crudTable").length <= 0) $('#customer-filter-form').submit();
        }
        // $(function () {
        //     if ($("#crudTable").length <= 0) {
        //         $(document).on('click', '#remove_filters_button', function () {
        //             $('#customer-filter-form').find('input').each(function (k, v) {
        //                 $(v).val('');
        //             });
        //             $('#customer-filter-form').find('select').each(function (k, v) {
        //                 $(v).val('');
        //             });
        //             mySearchSubmit();
        //         });
        //     }

        // });

        function addOrUpdateUriParameter(uri, parameter, value) {
            var new_url = normalizeAmpersand(uri);

            new_url = URI(new_url).normalizeQuery();

            // this param is only needed in datatables persistent url redirector
            // not when applying filters so we remove it.
            if (new_url.hasQuery('persistent-table')) {
                new_url.removeQuery('persistent-table');
            }

            if (new_url.hasQuery(parameter)) {
                new_url.removeQuery(parameter);
            }

            if (value != '') {
                new_url = new_url.addQuery(parameter, value);
            }

            $('#remove_filters_button').removeClass('invisible');

            return new_url.toString();

        }

        function normalizeAmpersand(string) {
            return string.replace(/&amp;/g, "&").replace(/amp%3B/g, "");
        }

        // button to remove all filters
        jQuery(document).ready(function($) {
            $("#remove_filters_button").click(function(e) {
                // e.preventDefault();
                if ($("#crudTable").length <= 0) {
                    $('#customer-filter-form').find('input').each(function (k, v) {
                        $(v).val('');
                    });
                    $('#customer-filter-form').find('select').each(function (k, v) {
                        $(v).val('');
                    });
                    mySearchSubmit();
                } else {
                    // behaviour for ajax table
                    var new_url = '{{ url($crud->route.'/search') }}';
                    var ajax_table = $("#crudTable").DataTable();

                    // replace the datatables ajax url with new_url and reload it
                    ajax_table.ajax.url(new_url).load();

                    // clear all filters
                    $(".navbar-filters li[filter-name]").trigger('filter:clear');

                    // remove filters from URL
                    crud.updateUrl(new_url);
                }
            });

            // hide the Remove filters button when no filter is active
            $(".navbar-filters li[filter-name]").on('filter:clear', function() {
                var anyActiveFilters = false;
                $(".navbar-filters li[filter-name]").each(function () {
                    if ($(this).hasClass('active')) {
                        anyActiveFilters = true;
                        // console.log('ACTIVE FILTER');
                    }
                });

                if (anyActiveFilters == false) {
                    $('#remove_filters_button').addClass('invisible');
                }
            });
        });
    </script>
@endpush
