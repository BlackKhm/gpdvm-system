@php
    $btnTab = 'btn_show_tabs';
@endphp
<div id="{{ $id }}" class="{{ $class }}">
    @include('partials.tab.index', [
        'title' => '',
        // 'titleIcon' => 'las la-times text-danger',
        'titleIcon' => '',
        // 'buttonCloseOverlay' => true,
        'reverseTab' => 'flex-row-reverse',
        'show' => false,
        'tabs' => [
            [
                'title' => trans('flexi.account'),
                'view'=> 'partials.sharable.content',
                'viewParams' => [
                    'btnIdentify' => 'share-hierachy',
                    'sharable' => $entry->shareToNewRole,
                    // 'data' => $entry->AllNewRoles,
                    'model' => $entry->newRoleNameSpace,
                    'attribute' => 'NameBackpackField',
                    'selectType' => 'ajax_nested',
                    'entity' =>  'account',
                    'sharableType' => config('const.options.sharable.new_role'),
                    'title' => trans('flexi.account'),
                    'crud' => $crud
                ],
                'active' => true
            ],
            [
                'title' => trans('flexi.user'),
                'view'=> 'partials.sharable.content',
                'viewParams' => [
                    'btnIdentify' => 'share-user',
                    'sharable' => $entry->shareToUser,
                    // 'data' => $entry->AllUsers,
                    'model' => $entry->userNameSpace,
                    'entity' => 'user',
                    'selectType' => 'ajax',
                    'sharableType' => config('const.options.sharable.user'),
                    'title' => trans('flexi.user')
                ],
            ],
            [
                'title' => trans('flexi.group'),
                'view'=> 'partials.sharable.content',
                'viewParams' => [
                    'btnIdentify' => 'share-group',
                    'sharable' => $entry->shareToGroup,
                    // 'data' => $entry->AllGroups,
                    'model' => $entry->groupNameSpace,
                    'entity' => 'group',
                    'selectType' => 'ajax',
                    'sharableType' => config('const.options.sharable.group'),
                    'title' => trans('flexi.group')
                ],
            ],
        ]
    ])
</div>
@push('after_scripts')
    @stack('crud_fields_scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
@endpush
