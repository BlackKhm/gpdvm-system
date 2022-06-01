<a href="#" class="btn btn-sm btn-secondary" data-toggle="dropdown">
    @if ($icon)
        <i class="{{ $icon }}"></i>
    @endif
</a>
<div class="dropdown-menu dropdown-menu-right" style="cursor: pointer;">
    @if (count($dropdown_items) > 0)
        @foreach ($dropdown_items as $item)
            @php
                $attributes = '';
            @endphp
            @foreach ($item['attributes'] as $k => $attr)
                @php
                    $attributes .= " $k=" . '"' . $attr . '"';
                @endphp
            @endforeach
            <a{!! $attributes !!}>
                {{ $item['text'] }}
            </a>
        @endforeach
    @endif
</div>
