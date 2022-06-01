@component('partials.sharable.overlay.index', [
    'views' => $views
])
@endcomponent

@push('after_styles')
    @stack('crud_fields_style')
    @component('partials.sharable.overlay.style', [
        'position' => isset($position) ? $position : 'right'
    ])
    @endcomponent
@endpush

@push('after_scripts')
    @stack('crud_fields_script')
    @component('partials.sharable.overlay.script', [
        'position' => isset($position) ? $position : 'right'
    ])
    @endcomponent
@endpush
