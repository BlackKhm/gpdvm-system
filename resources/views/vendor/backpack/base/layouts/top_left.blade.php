<!DOCTYPE html>

<html lang="{{ app()->getLocale() }}" dir="{{ config('backpack.base.html_direction') }}">

<head>
  @include(backpack_view('inc.head'))
  {{-- <link rel="manifest" href="{{ asset('manifest.json') }}"> --}}
</head>

<body class="{{ config('backpack.base.body_class') }}">

  @include(backpack_view('inc.main_header'))

  <div class="app-body">

    @include(backpack_view('inc.sidebar'))

    <main class="main pt-2 pb-4 mb-5">

       @includeWhen(isset($breadcrumbs), backpack_view('inc.breadcrumbs'))

       @yield('header')

        <div class="container-fluid animated fadeIn">

          @if (isset($widgets['before_content']))
            @include(backpack_view('inc.widgets'), [ 'widgets' => $widgets['before_content'] ])
          @endif

          @yield('content')

          @if (isset($widgets['after_content']))
            @include(backpack_view('inc.widgets'), [ 'widgets' => $widgets['after_content'] ])
          @endif

        </div>

    </main>

  </div><!-- ./app-body -->

  <footer class="{{ config('backpack.base.footer_class') }}">
    @include(backpack_view('inc.footer'))
  </footer>

  @include('partials.global_js_helper')
  @stack('content_before_scripts')
  @yield('before_scripts')
  @stack('before_scripts')

  @include(backpack_view('inc.scripts'))

  @php
    // baseURL: '{{ route("api.v2.vtrust_reports.index") }}',
    // http://192.168.100.16:9999/api/v2/vtrust_reports
    // baseURL: '{{ env("REPORT_URL", "") . "/api/v2/vtrust_reports" }}',
    // $route = env('REPORT_URL', '') . '/api/v2/vtrust_reports';
    // $url = Auth::user() ? $route . "?account_id=" . optional(Auth::user()->contact)->account_id : $route;
    // $url = Auth::user() ? 'http://127.0.0.1:9999/api/v2/vtrust_reports' . "?account_id=" . optional(Auth::user()->contact)->account_id : 'http://127.0.0.1:9999/api/v2/vtrust_reports';
    // baseURL: "{{ env('REPORT_URL', '') . 'api/v2/vtrust_reports' }}",
  @endphp
  <script>
      window.switchForm = component => {
        var value = component.val();

        if (value == 'Inquiry') {
            $('#inquiry_header nav span').text('{{trans("flexi.inquiry")}}');
        } else if (value == 'Listing') {
            $('#listing_header nav span').text('{{trans("flexi.listing")}}');
        }

        if (value == 'Referral - Inquiry') {
            value = 'Inquiry';
            $('#inquiry_header nav span').text('{{trans("flexi.referral_inquiry")}}');
        } else if (value == 'Referral - Listing') {
            value = 'Listing';
            $('#listing_header nav span').text('{{trans("flexi.referral_listing")}}');
        }

        var type = value ? value.split(' ')[0].toLowerCase() : '';
        if (!type) {
            return false;
        }
        var element = $(`.form-switch-${type}`);
        var leadTypes = element.attr('data-lead-type').split(',');
        leadTypes.splice(leadTypes.indexOf(type), 1)

        leadTypes.forEach(val => {
            var ele = $(`.form-switch-${val}`);
            ele.addClass('d-none');
        });

        element.removeClass('d-none');
    };
  </script>

  @yield('after_scripts')
  @stack('after_scripts')


</body>
</html>
