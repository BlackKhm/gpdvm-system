<!-- select2_nested -->

{{-- Thanks to Erwan Pianezza - https://github.com/breizhwave--}}

{{-- This field assumes you have a nested set Eloquent model, using: --}}
{{-- 1. children() as a properly defined relationship --}}
{{-- 2. depth, lft attributes --}}

@php
    $current_value = old($field['name']) ? old($field['name']) : (isset($field['value']) ? $field['value'] : (isset($field['default']) ? $field['default'] : '' ));

    $mainEntryId = isset($entry) && $entry ? $entry->id : -1;
    $count = 0;

    if (!function_exists('echoSelect2NestedEntry')) {
        function echoSelect2NestedEntry($entry, $field, $current_value, $mainEntryId) {
            if ($current_value == $entry->getKey()) {
                $selected = ' selected ';
            } else {
                $selected = '';
            }

            echo "<option value='".$entry->getKey()."' $selected>";
            echo str_repeat("-", (int)$entry->depth > 1 ? (int)$entry->depth - 1 : 0).' '.$entry->{$field['attribute']};
            echo "</option>";
        }
    }

    if (!function_exists('echoSelect2NestedChildren')) {
        function echoSelect2NestedChildren($entity, $field, $current_value, $mainEntryId)
        {
            global $count;
            $relationship = isset($field['load_entity']) && $field['load_entity'] ? $field['load_entity'] : 'children';
            // foreach ($entity->{$relationship}()->get() as $entry)
            foreach ($entity->{$relationship} as $entry)
            {
                if (backpack_user()->hasRole('Developer') && $count >= 50) {
                    break;
                }
                echoSelect2NestedEntry($entry, $field, $current_value, $mainEntryId);
                echoSelect2NestedChildren($entry, $field, $current_value, $mainEntryId);
                $count++;
            }
        }
    }
@endphp

@include('crud::fields.inc.wrapper_start')
    <label>{!! $field['label'] !!}</label>
    @include('crud::fields.inc.translatable_icon')
    <?php $entity_model = $crud->getRelationModel($field['entity'], -1); ?>
    <select
        name="{{ $field['name'] }}"
        style="width: 100%"
        data-init-function="bpFieldInitSelect2NestedElement"
        @include('crud::fields.inc.attributes', ['default_class' =>  'form-control select2_field'])
        >

        @if ($entity_model::isColumnNullable($field['name']))
            <option value="">-</option>
        @endif

        @if (isset($field['model']))
            @php
                $obj = new $field['model'];
                if (!isset($field['options'])) {
                    $first_level_items = $obj->query();
                    if (backpack_user()->hasRole('Developer')) {
                        $first_level_items = $first_level_items
                            ->where('depth', '1')
                            ->orWhere('depth', null)
                            ->orderBy('lft', 'ASC')
                            ->take(1)
                            ->get();
                    } else {
                        $first_level_items = $first_level_items
                            // ->IsSharableRead()
                            ->orWhere('id', optional(backpack_user()->contact)->account_id ?? -1)
                            ->orderBy('lft', 'ASC')
                            ->take(1)
                            ->get();
                    }
                    // $first_level_items = $obj->where('depth', '1')->orWhere('depth', null)->orderBy('lft', 'ASC')->get();
                } else {
                    $first_level_items = call_user_func($field['options'], $obj::query());
                }
                // $first_level_items = $obj->where('depth', '1')->orWhere('depth', null)->orderBy('lft', 'ASC')->get();
            @endphp

            @foreach ($first_level_items as $connected_entity_entry)
                @php
                    if (backpack_user()->hasRole('Developer') && $count >= 50) {
                        break;
                    }
                    echoSelect2NestedEntry($connected_entity_entry, $field, $current_value, $mainEntryId);
                    echoSelect2NestedChildren($connected_entity_entry, $field, $current_value, $mainEntryId);
                    $count++;
                @endphp
            @endforeach
        @endif
    </select>

    {{-- HINT --}}
    @if (isset($field['hint']))
        <p class="help-block">{!! $field['hint'] !!}</p>
    @endif
@include('crud::fields.inc.wrapper_end')

{{-- ########################################## --}}
{{-- Extra CSS and JS for this particular field --}}
{{-- If a field type is shown multiple times on a form, the CSS and JS will only be loaded once --}}
@if ($crud->fieldTypeNotLoaded($field))
    @php
        $crud->markFieldTypeAsLoaded($field);
    @endphp

    {{-- FIELD CSS - will be loaded in the after_styles section --}}
    @push('crud_fields_styles')
        <!-- include select2 css-->
        <link href="{{ asset('packages/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('packages/select2-bootstrap-theme/dist/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    @endpush

    {{-- FIELD JS - will be loaded in the after_scripts section --}}
    @push('crud_fields_scripts')
        <!-- include select2 js-->
        <script src="{{ asset('packages/select2/dist/js/select2.full.min.js') }}"></script>
        @if (app()->getLocale() !== 'en')
        <script src="{{ asset('packages/select2/dist/js/i18n/' . app()->getLocale() . '.js') }}"></script>
        @endif
        <script>
            function bpFieldInitSelect2NestedElement(element) {
                if (!element.hasClass("select2-hidden-accessible"))
                {
                    element.select2({
                        theme: "bootstrap"
                    });
                }
            }
        </script>
    @endpush

@endif
{{-- End of Extra CSS and JS --}}
{{-- ########################################## --}}
