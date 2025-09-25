@php
    $currentLocale = session('locale', config('app.locale', 'ar'));
    $isRtl = $currentLocale === 'ar';
@endphp

<!doctype html>
<html lang="{{ $currentLocale }}" dir="{{ $isRtl ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <title>{{ config('app.name', 'لوحة التحكم') }}</title>

    <!-- Simple bar CSS -->
    <link rel="stylesheet" href="{{ asset('light-rtl/css/simplebar.css') }}">
    <!-- Fonts CSS -->
     <link href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@200;300;400;500;700;800;900&display=swap" rel="stylesheet">
 
       @if($isRtl)
    <style>
        body { font-family: 'Tajawal', sans-serif; }
        .text-left { text-align: right !important; }
        .text-right { text-align: left !important; }
    </style>
    @else
    <style>
        body { font-family: 'Overpass', sans-serif; }
    </style>
    @endif
          
    <!-- Icons CSS -->
    <link rel="stylesheet" href="{{ asset('light-rtl/css/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('light-rtl/css/select2.css') }}">
    <link rel="stylesheet" href="{{ asset('light-rtl/css/dropzone.css') }}">
    <link rel="stylesheet" href="{{ asset('light-rtl/css/uppy.min.css') }}">
    <link rel="stylesheet" href="{{ asset('light-rtl/css/jquery.steps.css') }}">
    <link rel="stylesheet" href="{{ asset('light-rtl/css/jquery.timepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('light-rtl/css/quill.snow.css') }}">
    <!-- Date Range Picker CSS -->
    <link rel="stylesheet" href="{{ asset('light-rtl/css/daterangepicker.css') }}">
    <!-- App CSS -->
    <link rel="stylesheet" href="{{ asset('light-rtl/css/app-light.css') }}" id="lightTheme">
    <link rel="stylesheet" href="{{ asset('light-rtl/css/app-dark.css') }}" id="darkTheme" disabled>

    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.0/dist/sweetalert2.min.css">

    @stack('styles')
</head>

<body class="vertical light rtl">
    <div class="wrapper">
   
        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('light-rtl/js/jquery.min.js') }}"></script>
    <script src="{{ asset('light-rtl/js/popper.min.js') }}"></script>
    <script src="{{ asset('light-rtl/js/moment.min.js') }}"></script>
    <script src="{{ asset('light-rtl/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('light-rtl/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('light-rtl/js/daterangepicker.js') }}"></script>
    <script src="{{ asset('light-rtl/js/jquery.stickOnScroll.js') }}"></script>
    <script src="{{ asset('light-rtl/js/tinycolor-min.js') }}"></script>
    <script src="{{ asset('light-rtl/js/config.js') }}"></script>
    <script src="{{ asset('light-rtl/js/apps.js') }}"></script>

    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.0/dist/sweetalert2.min.js"></script>

    @stack('scripts')

    <script>
        // Global SweetAlert configuration
        window.Swal = Swal.mixin({
            confirmButtonText: 'موافق',
            cancelButtonText: 'إلغاء',
            confirmButtonColor: '#007bff',
            cancelButtonColor: '#6c757d'
        });

        // CSRF token for AJAX requests
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Language switching function
        function switchLanguage(locale) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '{{ route("language.switch") }}';

            const csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            form.appendChild(csrfToken);

            const localeInput = document.createElement('input');
            localeInput.type = 'hidden';
            localeInput.name = 'locale';
            localeInput.value = locale;
            form.appendChild(localeInput);

            document.body.appendChild(form);
            form.submit();
        }
    </script>
</body>

</html>
