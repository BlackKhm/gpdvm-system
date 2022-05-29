{{-- @include('partials.tab.index', [
    'title' => 'Tab Title',
    'titleIcon' => 'la la-home',
    'tabs' => [
        [
            'title' => 'land Information',
            'view'=> 'backpack.properties.components.land_information',
            // 'viewParams' => [],
            'active' => true,
        ],
        [
            'title' => 'Building Information',
            'view' => 'backpack.properties.components.building_information',
            // 'viewParams' => [],
            // 'active' => true,
        ],
        [
            'title' => 'Price History',
            'view' => 'backpack.properties.components.property_prices.price_history',
            // 'viewParams' => [],
            // 'active' => true,
        ],
    ],
]) --}}


@if(is_array($tabs) && count($tabs))

@php
    $tabBar = $tabContent = '';
    // add base64_encode to fix problem tab not toggle by uuid in url hash
    $setHash = base64_encode(Str::uuid());
@endphp
<div class="mnb-custom {{ isset($show) && !$show ? 'd-flex' : 'd-flex' }} flex-wrap w-100 mb-3 {{ $containerClass ?? 'bg-white' }}">
{{-- <div{{ isset($tabsIdentifier) ? ' id=' . $tabsIdentifier : '' }} class="mnb-custom d-none flex-wrap w-100 mb-3 {{ $containerClass ?? 'bg-white' }}"> --}}
    <div class="d-flex justify-content-between flex-wrap w-100{{ isset($reverseTab) ? ' ' . $reverseTab : '' }}">

        <ul class="nav" role="tabTitle">
            <li class="nav-item">
                <a class="nav-link" style="cursor: pointer;">
                    {{-- <a class="nav-link {{ isset($buttonCloseOverlay) && $buttonCloseOverlay ? 'button-close-overlay' : '' }}" style="cursor: pointer;"> --}}
                    @if(isset($titleIcon) && $titleIcon)
                        <i class="{{ $titleIcon }}"></i>
                    @endif
                    {!! $title !!}
                </a>
            </li>
        </ul>

        <ul class="nav nav-tabs" role="tablist">
            @foreach($tabs as $k => $v)
                @php
                    $isActive = isset($v['active']) && $v['active'] ? 'active' : '';
                @endphp
                <li class="nav-item" role="tablist">
                    <a
                        class="nav-link btn-tab-change {{ $isActive }}"
                        data-toggle="tab"
                        href="#{{ $setHash.$k }}"
                        role="tab"
                        data-type="{{ $v['title'] }}"
                    >
                        {!! $v['title'] !!}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>

    {{-- <div class="tab-content w-100">
        {!! $tabContent !!}
    </div> --}}

    <div class="tab-content w-100">
        @foreach($tabs as $k => $v)
            @php
                $isActive = isset($v['active']) && $v['active'] ? 'active' : '';

                $view = isset($v['view']) && $v['view'] ? $v['view'] : '';

            @endphp
            @if($view)
                <div
                    class="tab-pane fade {{ $isActive ? 'show active' : '' }}"
                    id="{{ $setHash.$k }}"
                    role="tabpanel"
                    aria-labelledby="{{ $v['title'] }}"
                >
                    @if(isset($v['viewParams']) && is_array($v['viewParams']) && $v['viewParams'])
                        @include($view, $v['viewParams'])
                    @else
                        @include($view)
                    @endif
                </div>
            @endif
        @endforeach
    </div>
</div>
@push('after_scripts')
    <script>
        $(function() {
            // @if (isset($tabsIdentifier))
            //     if ('tabs_sharable' in localStorage && localStorage.getItem('tabs_sharable') === 'show') {
            //         $('#{{ $tabsIdentifier }}').removeClass('d-none');
            //         $('#{{ $tabsIdentifier }}').addClass('d-flex');
            //     } else {
            //         $('#{{ $tabsIdentifier }}').removeClass('d-flex');
            //         $('#{{ $tabsIdentifier }}').addClass('d-none');
            //     }
            // @endif

            // @if (isset($closeRef))
            //     $('.button-close-overlay').on('click', function() {
            //         $('#{{ $closeRef }}').trigger('click');
            //     });
            // @endif

            $('.btn-tab-change').on('click', function() {
                document.cookie = `tab_type=${$(this).data('type')}`;
            });
        });
    </script>
@endpush
@endif
