<script>
    if (typeof rmRemoveErrorHtml != 'function') {
        function rmRemoveErrorHtml (jqForm) {
            jqForm.find('.help-block').remove();
            jqForm.find('.has-error').removeClass('has-error');
        }
    }

    if (typeof rmResetBasicForm != 'function') {
        function rmResetBasicForm (jqForm) {
            rmRemoveErrorHtml(jqForm)
            jqForm.find(`input`).val('').change();
            jqForm.find(`select`).val('').change();
            jqForm.find(`textarea`).val('').change();
        }
    }

    if (typeof rmAlert != 'function') {
        function rmAlert (text, type = 'success') {
            new Noty({
                type: type,
                text: text
            }).show();
        }
    }

    if (typeof rmIsObject != 'function') {
        function rmIsObject (obj, name) {
            return Object.prototype.hasOwnProperty.call(obj, name) ? obj[name] : '';
            // return obj.hasOwnProperty(name) ? obj[name] : '';
        }
    }

    if (typeof rmCloneForm != 'function') {
        function rmCloneForm (jqForm, cloneFormId) {
            const formId = $('#' + cloneFormId)
            const isForm = formId.find('form')
            // console.log(isForm.length)
            if (isForm && isForm.length) {
                jqForm.html(isForm.html())
            } else {
                // console.log(jqForm)
                jqForm.html(
                    formId.html()
                )
            }
        }
    }

    if (typeof rmCatchValidateMessageError != 'function') {
        function rmCatchValidateMessageError (e, jqForm, isJqueryAjax = false) {

            if (isJqueryAjax) {
                var status = e.status;
                var errors = e.responseJSON.errors;
            } else {
                var status = e.response.status;
                var errors = e.response.data.errors;
            }

            // if (e.response.status != 422) {
            if (status!= 422) {
                rmAlert('{{ trans("flexi.something_when_wrong") }}', 'danger')
            } else {
                // jqForm.find('')
                var error = errors;
                rmRemoveErrorHtml(jqForm)
                Object.keys(error).forEach(element => {
                    let splitElement = element.split('.')
                    if (splitElement.length > 1) {
                        jqForm.find(`input[name="${splitElement[0]}[]"]`).closest('.form-group').addClass('has-error');
                        jqForm.find(`input[name="${splitElement[0]}[]"]`).closest('.form-group').append('<p class="help-block text-danger">'+error[element]+'</p>');
                    } else {
                        jqForm.find(`input[name="${element}"]`).closest('.form-group').addClass('has-error');
                        jqForm.find(`select[name="${element}"]`).closest('.form-group').addClass('has-error');
                        jqForm.find(`textarea[name="${element}"]`).closest('.form-group').addClass('has-error');
                        jqForm.find(`input[name="${element}"]`).closest('.form-group').append('<p class="help-block text-danger">'+error[element]+'</p>');
                        jqForm.find(`select[name="${element}"]`).closest('.form-group').append('<p class="help-block text-danger">'+error[element]+'</p>');
                        jqForm.find(`textarea[name="${element}"]`).closest('.form-group').append('<p class="help-block text-danger">'+error[element]+'</p>');
                    }
                    // jqForm.find(`input[name="${element}"]`).parent().addClass('has-error');
                    // jqForm.find(`select[name="${element}"]`).parent().addClass('has-error');
                    // jqForm.find(`textarea[name="${element}"]`).parent().addClass('has-error');
                    // jqForm.find(`input[name="${element}"]`).parent().append('<p class="help-block text-danger">'+error[element]+'</p>');
                    // jqForm.find(`select[name="${element}"]`).parent().append('<p class="help-block text-danger">'+error[element]+'</p>');
                    // jqForm.find(`textarea[name="${element}"]`).parent().append('<p class="help-block text-danger">'+error[element]+'</p>');
                });
            }
        }
    }
    if (typeof rmInitializeFieldsWithJavascript != 'function') {
        // Clone backpack initFunction
        function rmInitializeFieldsWithJavascript(container) {
            var selector;
            if (container instanceof jQuery) {
                selector = container;
            } else {
                selector = $(container);
            }
            selector.find("[data-init-function]").not("[data-initialized=true]").each(function () {
                var element = $(this);
                var functionName = element.data('init-function');

                if (typeof window[functionName] === "function") {
                window[functionName](element);

                // mark the element as initialized, so that its function is never called again
                element.attr('data-initialized', 'true');
                }
            });
        }
    }
</script>
{{-- <script src="{{ asset('js/measure_tool.js') }}"></script> --}}
{{-- <script src="https://maps.googleapis.com/maps/api/js{{ $enableDrawing ? '?libraries=drawing' : '' }}"></script> --}}

{{-- @push('after_scripts')
    <script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/politespace.js"></script>
    <script>
        $(document).trigger("enhance");
    </script>
@endpush --}}
