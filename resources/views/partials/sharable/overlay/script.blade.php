<script type="text/javascript">
    $(function() {
        $('#mySidenav').scroll(function() {
            if ($(this).scrollTop() > 28) {
                $('#back_to_top').removeClass('d-none').fadeIn();
            } else {
                $('#back_to_top').addClass('d-none').fadeOut();
            }
        });
        $('.btn-open-sidebar').on('click', function() {
            if ($(this).attr('data-toggle') && $(this).attr('data-toggle') == 0) {
                $('#mySidenav').removeAttr('style');
                $(this).attr('data-toggle', '1');
                return false;
            }

            $('#mySidenav').css('{{ $position ?? "right" }}', '0');
            $(this).attr('data-toggle', '0');
            var id = $(this).attr('data-id');
            $('.button-close-overlay').attr('data-id', id);
            $(`#${id}`).removeClass('d-none');
        });

        $('.button-close-overlay').on('click', function() {
            $('#mySidenav').removeAttr('style');
            $('.btn-open-sidebar').attr('data-toggle', '1');
            $('#back_to_top').addClass('d-none').fadeOut();
            var id = $(this).attr('data-id');
            $(`#${id}`).addClass('d-none');
        });
    });
</script>
