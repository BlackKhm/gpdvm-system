@if (count($data))
    @php
        $dropdownItems = [];
        $views = [];
    @endphp
    @foreach ($data as $item)
        @php
            array_push($dropdownItems, $item['dropdown-item']);
            $item['view-data']['attribute'] = array_merge($item['view-data']['attribute'], [
                'entry' => $entry,
                'crud' => $crud
            ]);

            $view = view($item['view-data']['view-path'], $item['view-data']['attribute']);
            array_push($views, $view);
        @endphp
    @endforeach

    @component('partials.sharable.setting_dropdown', [
        'icon' => 'la la-cog',
        'dropdown_items' => $dropdownItems
    ])
    @endcomponent
    @component('partials.sharable.sidebar_overlay', [
        'views' => $views
    ])
    @endcomponent
@endif
