@php
    $selectName = isset($model) ? 'sharable_id' : '';
@endphp
    <div id="macf-{{ $btnIdentify }}-lists" class="{{ $wrapperListClass ?? 'col-12 px-0' }}">
        <div class="d-flex">
            <h4 class="text-capitalize font-weight-bold">{{ $title }}</h4>
            <button
                class="btn btn-link ml-auto"
                id="btn-collapse-{{ $btnIdentify }}"
                data-toggle="collapse"
                href="#collapse-{{ $btnIdentify }}"
                role="button"
                aria-expanded="false"
                aria-controls="collapse-{{ $btnIdentify }}"
            >
                {{ trans('flexi.add') }}+
            </button>
            {{-- <button class="btn btn-danger btn-sm">
                <i class="las la-times la-1x"></i>
            </button> --}}
        </div>
        <div class="collapse" id="collapse-{{ $btnIdentify }}">
            <div class="card card-body">
                <form @submit.prevent="onSubmit">
                    <div class="form-row">
                        {{-- <div class="form-group col-md-5"> --}}
                            <input type="hidden" v-model="form.sharable_type" name="sharable_type">
                            {{-- <label>Name <span class="text-danger">*</span></label> --}}
                            {{-- <select name="sharable_id" v-model="form.sharable_id" class="form-control" @change="getName($event)">
                                <option v-for="(val, key) in types" :value="key" :key="key">@{{ val }}</option>
                            </select> --}}
                            {{-- @php
                                dd($model);
                            @endphp --}}
                            @if (isset($selectType) && $selectType === 'nested')
                                @if (isset($model))
                                    @include('partials.sharable.select2_nested', ['field' => [
                                        'type' => 'partials.sharable.select2_nested',
                                        'label' => trans('flexi.name') . ' <span class="text-danger">*</span>',
                                        'name' => $selectName,
                                        'model' => $model,
                                        'entity' => 'children',
                                        'load_entity' => 'childrenByMaxReorder',
                                        'attribute' => 'name',
                                        'attributes' => [
                                            'id' => $selectName . '_select_option'
                                        ],
                                        'wrapper' => [
                                            'class' => 'form-group col-md-5'
                                        ]
                                    ]])
                                @endif
                            @elseif (isset($selectType) && $selectType === 'ajax')
                                @if (isset($model) && isset($entity))
                                    @include('crud::fields.select2_from_ajax', ['field' => [   // 1-n relationship
                                        'label'       => trans('flexi.name') . ' <span class="text-danger">*</span>', // Table column heading
                                        'type'        => 'select2_from_ajax',
                                        'name'        => $selectName, // the column that contains the ID of that connected entity
                                        'entity'      => $entity, // the method that defines the relationship in your Model
                                        'attribute'   => isset($attribute) ? $attribute : 'full_name', // foreign key attribute that is shown to user
                                        'data_source' => route('web-api.backpack.fields') . '?set_entry=' . Str::plural($entity, 2) . ',NameBackpackField,id,sharable_select_ajax', // url to controller search function (with /{id} should return model)
                                        'placeholder'             => "-", // placeholder for the select
                                        'minimum_input_length'    => 1, // minimum characters to type before querying results
                                        'model'                   => $model, // foreign key model
                                        'attributes' => [
                                            'id' => $selectName . '_select_option_' . $entity
                                        ],
                                        'wrapper' => [
                                            'class' => 'form-group col-md-5'
                                        ]
                                        // 'dependencies'            => ['category'], // when a dependency changes, this select2 is reset to null
                                        // 'method'                  => 'GET', // optional - HTTP method to use for the AJAX call (GET, POST)
                                        // 'include_all_form_fields' => false, // optional - only send the current field through AJAX (for a smaller payload if you're not using multiple chained select2s)
                                    ]])
                                @endif
                            @elseif (isset($selectType) && $selectType === 'ajax_nested')
                                @if (isset($model) && isset($entity))
                                    @include('crud::fields.flexi.select2_ajax_nested', ['field' => [
                                        'type' => 'crud::fields.flexi.select2_ajax_nested',
                                        'label' => trans('flexi.name') . ' <span class="text-danger">*</span>',
                                        'placeholder'   => trans('flexi.name'),
                                        'data_source'   => route('web-api.ajax-nested') . '?set_entry=' . Str::plural($entity, 2) . ',' . $attribute . ',id',
                                        'name' => $selectName,
                                        'entity' => 'children',
                                        'attribute' => $attribute, // foreign key attribute that is shown to user
                                        'minimum_input_length' => -1,
                                        'model'      => $model, // foreign key model
                                        'attributes' => [
                                            'id' => $selectName . '_select_option_' . $entity
                                        ],
                                        'wrapper' => [
                                            'class' => 'form-group col-md-5'
                                        ],
                                        'include_all_form_fields' => false
                                    ]])
                                @endif
                            @endif
                            <input type="hidden" name="name" :value="sharable_name">
                        {{-- </div> --}}
                        <div class="form-group col-md-5">
                            <label>{{ trans('flexi.access_level') }} <span class="text-danger">*</span></label>
                            {{-- <select name="access_level" v-model="form.access_level" class="form-control">
                                <option v-for="(text, val) in options" :value="val" :key="val">@{{ text }}</option>
                            </select> --}}
                            <select
                                name="access_level"
                                {{-- v-model="form.access_level" --}}
                                id="create_access_level_{{ $btnIdentify }}"
                                class="form-control js-example-basic-multiple"
                                multiple="multiple"
                            >
                                <option v-for="(text, val) in options" :value="text" :key="val">@{{ text }}</option>
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label>{{ trans('flexi.action') }}</label>
                            <button
                                type="submit"
                                class="btn btn-link btn-sm text-primary"
                                id="btn-save-{{ $btnIdentify }}"
                                :disabled="disableSave"
                            >
                                <i class="la la-save la-2x"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table" id="{{ $btnIdentify }}-table">
                <thead>
                    <tr>
                        <th>{{ trans('flexi.name') }}</th>
                        <th>{{ trans('flexi.access_level') }}</th>
                        <th>{{ trans('flexi.action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(item, index) in items" :key="item.id">
                        <td class="align-middle">@{{ item.name }}</td>
                        <td class="align-middle">
                            {{-- <select name="accessLevel" id="accessLevel" class="form-control" @change="changeAccessLevel($event, item, index)">
                                <option v-for="(text, val) in options" :value="val" :key="val" :selected="item.access_level === val">@{{ text }}</option>
                            </select> --}}
                            <select
                                name="accessLevel[]"
                                class="form-control js-example-basic-multiple access-levels-{{ $btnIdentify }}"
                                multiple="multiple"
                                :id="item.dom_id ? item.dom_id : ''"
                                :data-item="JSON.stringify(item)"
                                :data-index="index"
                                {{-- :disabled="item.parents.includes(item.new_role_id)" --}}
                                {{-- @change="changeAccessLevel($event, item, index)" --}}
                            >
                                <option v-for="(text, val) in options" :value="text" :key="text" :selected="item && item.access_level && item.access_level.length > 0 && item.access_level.includes(text)">@{{ text }}</option>
                            </select>
                        </td>
                        <td class="align-middle">
                            {{-- v-bind:class="[item.parents.includes(item.new_role_id) ? dNoneClass : '']" --}}
                            <a href="#" class="text-danger" @click="deleteSharable($event, item, index)">
                                <i class="la la-trash"></i>
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
{{-- @include('partials.sharable.content', ['btnIdentify' => 'share-hierachy', 'sharable' => $entry->shareToNewRole, 'newRoles' => $newRoles]) --}}
@php $scriptApp = Str::camel($btnIdentify); @endphp
@push('crud_fields_styles')
    <style>
        .select2-container {
            width: 100% !important;
        }

        .select2-dropdown {
            box-shadow: 0 6px 12px rgba(0,0,0,.175) !important;
            border-color: rgba(0,40,100,.12) !important;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #fff !important;
            border: 1px solid #ccc !important;
            color: #555 !important;
        }

        .select2-selection--single .select2-selection__rendered {
            line-height: 25px !important;
        }

        .select2-container--default .select2-selection--multiple,
        .border-selection {
            border: 1px solid rgba(0,40,100,.12) !important;
        }
    </style>
@endpush
@if (isset($entity) && $entity)
    @php
        $selector = $selectName . '_select_option_' . $entity;
    @endphp
@else
    @php
        $selector = $selectName . '_select_option';
    @endphp
@endif
{{-- types: JSON.parse('{!! $data !!}'), --}}
{{-- var {{ Str::camel('macf-'.$btnIdentify.'-list') }} = --}}
@push('after_scripts')
    <script>
        var {{ $scriptApp }} = new Vue({
            el: '#macf-{{ $btnIdentify }}-lists',
            data: function () {
                return {
                    form: {
                        sharable_type: '{{ $sharableType }}'
                    },
                    options: @json(config('const.options.sharable.access_levels')),
                    items: @json(\App\Http\Resources\AjaxModal\SharableResource::collection($sharable)),
                    sharable_name: '',
                    disableSave: false,
                    // dNoneClass: 'd-none'
                }
            },
            methods: {
                getName: function(e) {
                    this.sharable_name = e.target.options[e.target.selectedIndex].text;
                    // $('#sharable_name').val(e.target.options[e.target.selectedIndex].text);
                },
                onSubmit: function() {
                    const vm = this;
                    const row_id = window.location.pathname.split("/")[3];
                    const { access_level, sharable_type, sharable_id } = this.form;
                    let data = {
                        access_level,
                        sharable_type,
                        sharable_id,
                        set_table: "{{ with(new $entry)->getTable() }}"
                    };
                    console.log(data);
                    this.disableSave = true;
                    axios({
                        method: 'POST',
                        url: `{{ url('admin/api/sharable/role/${row_id}') }}`,
                        data
                    })
                        .then(async res => {
                            // this.items = res.data.data
                            const findIdex = this.items.findIndex(function (element) {
                                return element.id == res.data.data.id
                            });

                            if (findIdex !== -1) {
                                this.$set(this.items, findIdex, res.data.data);
                            }
                            // else {
                                // res.data.data.dom_id = 'new_item_{{ $btnIdentify }}';
                                // this.items.push(res.data.data);
                                // console.log('clicked: ', $('#{{ $btnIdentify }}-table').children('tbody').find('tr#new_item_share-hierachy'));
                                // this.script = true;
                            // }
                            // console.log(this.items[findIdex])
                            // // this.items[findIdex] = res.data.data
                            // console.log(this.items[findIdex])
                            // this.items.push(res.data.data)
                            const { data: { data, message } } = res;
                            if (message.attached && message.attached.length > 0) {
                                data.row_id = row_id;
                                data.name = this.sharable_name;
                                // const getLastRow = $('#{{ $btnIdentify }}-table tbody').find('tr').last();
                                // $(getLastRow).find('td').first().text(this.sharable_name);
                                // $(getLastRow).clone().appendTo('#{{ $btnIdentify }}-table tbody');
                                // console.log(data);
                                this.items.push(data);
                                this.$nextTick(() => {
                                    $('.access-levels-{{ $btnIdentify }}').select2();
                                    this.addSelect2Event();
                                });
                            } else if (message.updated && message.updated.length > 0) {
                                this.items = await this.items.filter(val => {
                                    return val.id != data.id;
                                });
                                data.dom_id = 'access-levels-updated-{{ $btnIdentify }}';
                                this.items.push(data);
                                $('.access-levels-{{ $btnIdentify }}').trigger('change');
                            }
                            await rmAlert('Success', type = 'success');
                            this.form = {
                                sharable_type: '{{ $sharableType }}'
                            };
                            this.disableSave = false;
                            $('#btn-collapse-{{ $btnIdentify }}').click();
                            $('#create_access_level_{{ $btnIdentify }}').val([]).change();
                            @if (isset($selector))
                                $('#{{ $selector }}').val([]).change();
                            @endif
                        })
                        .catch(err => {
                            const { response } = err;
                            if (response && response.status === 422 && response.data.message) {
                                rmAlert(response.data.message, 'danger');
                                this.disableSave = false;
                            }
                        });
                    // $('#new_item_{{ $btnIdentify }} .access-levels-{{ $btnIdentify }}').select2({
                    //     tags: true
                    // });
                },
                addSelect2Event: function() {
                    const vm = this;
                    $('.access-levels-{{ $btnIdentify }}')
                        .on('select2:select', function(e) {
                            const value = e.params.data.id;
                            let newVals = [];
                            if (value !== 'All' && $(this).val().includes('All')) {
                                newVals = $(this).val().filter(function(val) {
                                    return val !== 'All';
                                });
                            }
                            if (newVals.length > 0) {
                                $(this).val(newVals).trigger('change');
                            } else {
                                vm.checkIfContainAll($(this));
                            }
                            vm.checkIfContainAll($(this));
                            // console.log($(this).data('item'));
                            // console.log($(this).data('index'));
                            $(this).data('item').access_level = $(this).val();
                            vm.changeAccessLevel($(this).data('item'), $(this).data('index'));
                        })
                        .on('select2:unselect', function(e) {
                            if ($(this).val().length <= 0) {
                                $(this).val([e.params.data.id]).trigger('change');
                                rmAlert('Can not remove the last item!', 'warning');
                                return false;
                            }
                            $(this).data('item').access_level = $(this).val();
                            vm.changeAccessLevel($(this).data('item'), $(this).data('index'));
                        });
                },
                changeAccessLevel: function(item, index) {
                    // console.log(item);
                    // const { sharable_id, sharable_type } = item;
                    const old_access_level = item.access_level;
                    item.set_table = "{{ with(new $entry)->getTable() }}";
                    // item.access_level = e.target.value;
                    axios({
                        method: 'PUT',
                        url: `{{ url('admin/api/sharable/role/${item.row_id}') }}`,
                        data: {
                            ...item
                        }
                    })
                        .then(res => {
                            rmAlert('Success', type = 'success');
                        })
                        .catch(err => {
                            item.access_level = old_access_level;
                            rmAlert('danger', type = 'danger');
                        });
                },
                // changeAccessLevel: function() {
                //     const old_access_level = item.access_level;
                //     item.set_table = "{{  with(new $entry)->getTable() }}";
                //     item.access_level = e.target.value;
                //     axios({
                //         method: 'PUT',
                //         url: `{{ url('admin/api/sharable/role/${item.row_id}') }}`,
                //         data: {
                //             ...item
                //         }
                //     })
                //         .then(res => {
                //             rmAlert('Success', type = 'success');
                //         })
                //         .catch(err => {
                //             item.access_level = old_access_level;
                //             rmAlert('danger', type = 'danger');
                //         });
                // },
                deleteSharable: function(e, item, index) {
                    item.set_table = "{{ with(new $entry)->getTable() }}";
                    item.access_level = e.target.value;
                    axios({
                        method: 'DELETE',
                        url: `{{ url('admin/api/sharable/role/${item.row_id}') }}`,
                        data: {
                            ...item
                        }
                    })
                        .then(res => {
                            this.items.splice(index, 1);
                            rmAlert('Success!', type = 'success');
                        })
                        .catch(err => {
                            rmAlert('danger', type = 'danger');
                        });
                },
                checkIfContainAll: function(element) {
                    const vals = element.val().filter(val => val === 'All');
                    if (vals.length > 0) {
                        element.val(vals).trigger('change');
                    }
                }
            },
            // watch: {
            //     script: function() {
            //         console.log($('#new_item_{{ $btnIdentify }}'));
            //     }
            // },
            mounted() {
                // $('#new_item_{{ $btnIdentify }} .access-levels-{{ $btnIdentify }}').select2();
                const vm = this;

                $('#create_access_level_{{ $btnIdentify }}')
                    .on('select2:select', function(e) {
                        // const vals = $(this).val().filter(val => val === 'all');
                        // if (vals.length > 0) {
                        //     $(this).val(vals).trigger('change');
                        // }
                        const value = e.params.data.id;
                        let newVals = [];
                        if (value !== 'All' && $(this).val().includes('All')) {
                            newVals = $(this).val().filter(function(val) {
                                return val !== 'All';
                            });
                        }
                        if (newVals.length > 0) {
                            $(this).val(newVals).trigger('change');
                        } else {
                            vm.checkIfContainAll($(this));
                        }
                        vm.form.access_level = $(this).val();
                    })
                    .on('select2:unselect', function(e) {
                        vm.form.access_level = $(this).val();
                    });
                this.addSelect2Event();
                // $('.access-levels-{{ $btnIdentify }}')
                //     .on('select2:select', function(e) {
                //         const value = e.params.data.id;
                //         let newVals = [];
                //         if (value !== 'All' && $(this).val().includes('All')) {
                //             newVals = $(this).val().filter(function(val) {
                //                 return val !== 'All';
                //             });
                //         }
                //         if (newVals.length > 0) {
                //             $(this).val(newVals).trigger('change');
                //         } else {
                //             vm.checkIfContainAll($(this));
                //         }
                //         vm.checkIfContainAll($(this));
                //         // console.log($(this).data('item'));
                //         // console.log($(this).data('index'));
                //         $(this).data('item').access_level = $(this).val();
                //         vm.changeAccessLevel($(this).data('item'), $(this).data('index'));
                //     })
                //     .on('select2:unselect', function(e) {
                //         if ($(this).val().length <= 0) {
                //             $(this).val([e.params.data.id]).trigger('change');
                //             rmAlert('Can not remove the last item!', 'warning');
                //             return false;
                //         }
                //         $(this).data('item').access_level = $(this).val();
                //         vm.changeAccessLevel($(this).data('item'), $(this).data('index'));
                //     });
            },
            // computed: {
            //     items: function (val) {
            //         $('.access-levels-{{ $btnIdentify }}').select2();
            //         return false;
            //     }
            // }
        });
        $(function() {
            $('#create_access_level_{{ $btnIdentify }}').select2();
            $('.access-levels-{{ $btnIdentify }}').select2();

            $(document).on('change', '.access-levels-{{ $btnIdentify }} #access-levels-updated-{{ $btnIdentify }} #{{ $selector }} #create_access_level_{{ $btnIdentify }}', function() {
                $('#access-levels-updated-{{ $btnIdentify }}').val({{ $scriptApp }}.items[{{ $scriptApp }}.items.length - 1]);
            });

            @if (isset($selector))
                $('#{{ $selector }}').on('change', function(e) {
                    {{ $scriptApp }}.sharable_name = e.target.selectedOptions.length > 0 ? e.target.selectedOptions[0].text.replace(/-/g, '').trim() : '';
                    {{ $scriptApp }}.form.sharable_id = e.target.value;
                });
            @endif
        });
    </script>
@endpush


