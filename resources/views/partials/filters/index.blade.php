
@if (isset($crud) && $crud->filtersEnabled())
    @php
        $wrapperClass = $wrapperClass ?? '';
    @endphp
    {{-- {{ in_array(Request::segment(2), ['propertymap', 'casemap']) ? '' : 'btn-default' }} --}}
    {{-- {{ $wrapperClass }} --}}
    <a href="#/" class="btn btn-default btn-open-sidebar">
        <i class="la la-filter"></i> Filter
    </a>
    @push('content_before_scripts')
        @include('partials.sharable.overlay.index', [
            'views' => [
                view('partials.filters.content', ['crud' => $crud])
            ]
        ])
    @endpush
    @push('crud_list_styles')
        @include('partials.filters.style')
    @endpush

    @push('crud_list_scripts')
        {{-- @include('partials.sharable.overlay.index', [
            'views' => [
                view('partials.filters.content', ['crud' => $crud])
            ]
        ]) --}}
        @include('partials.sharable.overlay.script')
        <script>
            // $(document).on('click', 'a.nav-link.dropdown-toggle', function () {
            $('a.nav-link.dropdown-toggle').on('click', function () {
                $dropdown = $(this).closest('li').find('.dropdown-menu')
                // $dataAttribute = $dropdown.attr('data-hide-menu')
                // if ($dataAttribute === 'true') {
                //     $dropdown.attr('data-hide-menu', 'false')
                //     $dropdown.css({'display':'block', 'position': 'static'})
                // } else {
                //     $dropdown.attr('data-hide-menu', 'true')
                //     $dropdown.css({'display':'none', 'position': 'absolute'})
                // }
                $dropdown.toggleClass('hide-menu');
                // if ($dropdown.hasClass("hide-menu")) {
                //     $dropdown.removeClass('hide-menu')
                // } else {
                //     $dropdown.addClass('hide-menu')
                // }

            })
        </script>
    @endpush
@endif
