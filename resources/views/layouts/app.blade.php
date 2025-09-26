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
    <title>{{ config('app.name', __('dashboard.title')) }}</title>

    <!-- Simple bar CSS -->
    <link rel="stylesheet" href="{{ asset('light-rtl/css/simplebar.css') }}">
    <!-- Fonts CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@200;300;400;500;700;800;900&display=swap" rel="stylesheet">
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

    <!-- Dynamic CSS based on language -->
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

    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.0/dist/sweetalert2.min.css">

    @stack('styles')
</head>
<body class="vertical light {{ $isRtl ? 'rtl' : 'ltr' }}">
    <div class="wrapper">
        <nav class="topnav navbar navbar-light">
    <button type="button" class="navbar-toggler text-muted mt-2 p-0 {{ $isRtl ? 'mr-3' : 'ml-3' }} collapseSidebar">
        <i class="fe fe-menu navbar-toggler-icon"></i>
    </button>
    <form class="form-inline {{ $isRtl ? 'mr-auto' : 'ml-auto' }} searchform text-muted" action="{{ route('search.index') }}" method="GET">
        <input class="form-control {{ $isRtl ? 'mr-sm-2' : 'ml-sm-2' }} bg-transparent border-0 {{ $isRtl ? 'pl-4' : 'pr-4' }} text-muted" type="search" name="q" placeholder="{{ __('dashboard.search_placeholder') }}" aria-label="Search">
    </form>
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link text-muted my-2" href="#" id="modeSwitcher" data-mode="light">
                <i class="fe fe-sun fe-16"></i>
            </a>
        </li>

        <!-- Language Switcher -->
        <li class="nav-item">
            <x-language-switcher :currentLocale="$currentLocale" />
        </li>

       
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-muted {{ $isRtl ? 'pr-0' : 'pl-0' }}" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="avatar avatar-sm mt-2">
                    <img src="{{ asset('light-rtl/assets/avatars/face-1.jpg') }}" alt="..." class="avatar-img rounded-circle">
                </span>
            </a>
            <div class="dropdown-menu {{ $isRtl ? 'dropdown-menu-right' : 'dropdown-menu-left' }}" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="{{ route('profile.edit') }}">{{ __('dashboard.profile') }}</a>
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> {{ __('dashboard.logout') }}</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </li>
    </ul>
</nav>

<!-- Sidebar -->
<aside class="sidebar-left border-right bg-white shadow" id="leftSidebar" data-simplebar>
    <a href="#" class="btn collapseSidebar toggle-btn d-lg-none text-muted {{ $isRtl ? 'ml-2' : 'mr-2' }} mt-3" data-toggle="toggle">
        <i class="fe fe-x"><span class="sr-only"></span></i>
    </a>
    <nav class="vertnav navbar navbar-light">
        <div class="w-100 mb-4 d-flex">
            <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="{{ url('/') }}">
                <img src="{{ asset('logo.svg') }}" alt="Logo" class="navbar-brand-img brand-sm" style="max-height: 40px;">
            </a>
        </div>
        <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item w-100">
                <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                    <i class="fe fe-home fe-16"></i>
                    <span class="{{ $isRtl ? 'ml-3' : 'mr-3' }} item-text">{{ __('dashboard.dashboard') }}</span>
                </a>
            </li>

            <li class="nav-item w-100">
                <a class="nav-link" href="{{ route('users.index') }}">
                    <i class="fe fe-users fe-16"></i>
                    <span class="{{ $isRtl ? 'ml-3' : 'mr-3' }} item-text">{{ __('dashboard.users_management') }}</span>
                </a>
            </li>
            <li class="nav-item w-100">
                <a class="nav-link" href="{{ route('customers.index') }}">
                    <i class="fe fe-user fe-16"></i>
                    <span class="{{ $isRtl ? 'ml-3' : 'mr-3' }} item-text">{{ __('dashboard.customers_management') }}</span>
                </a>
            </li>
            <li class="nav-item w-100">
                <a class="nav-link" href="{{ route('services.index') }}">
                    <i class="fe fe-briefcase fe-16"></i>
                    <span class="{{ $isRtl ? 'ml-3' : 'mr-3' }} item-text">{{ __('dashboard.services_management') }}</span>
                </a>
            </li>
            <li class="nav-item w-100">
                <a class="nav-link" href="{{ route('invoices.index') }}">
                    <i class="fe fe-file-text fe-16"></i>
                    <span class="{{ $isRtl ? 'ml-3' : 'mr-3' }} item-text">{{ __('dashboard.invoices_management') }}</span>
                </a>
            </li>
            <li class="nav-item w-100">
                <a class="nav-link" href="{{ route('company-goals.index') }}">
                    <i class="fe fe-target fe-16"></i>
                    <span class="{{ $isRtl ? 'ml-3' : 'mr-3' }} item-text">{{ __('dashboard.company_goals') }}</span>
                </a>
            </li>
            <li class="nav-item w-100">
                <a class="nav-link" href="{{ route('partners.index') }}">
                    <i class="fe fe-user fe-16"></i>
                    <span class="{{ $isRtl ? 'ml-3' : 'mr-3' }} item-text">{{ __('dashboard.partners_management') }}</span>
                </a>
            </li>
            <li class="nav-item w-100">
                <a class="nav-link" href="{{ route('contacts.index') }}">
                    <i class="fe fe-phone fe-16"></i>
                    <span class="{{ $isRtl ? 'ml-3' : 'mr-3' }} item-text">{{ __('dashboard.contact_info') }}</span>
                </a>
            </li>
            <li class="nav-item w-100">
                <a class="nav-link" href="{{ route('testimonials.index') }}">
                    <i class="fe fe-star fe-16"></i>
                    <span class="{{ $isRtl ? 'ml-3' : 'mr-3' }} item-text">{{ __('dashboard.testimonials_management') }}</span>
                </a>
            </li>
            <li class="nav-item w-100">
                <a class="nav-link" href="{{ route('blogs.index') }}">
                    <i class="fe fe-file-text fe-16"></i>
                    <span class="{{ $isRtl ? 'ml-3' : 'mr-3' }} item-text">{{ __('dashboard.blogs_management') }}</span>
                </a>
            </li>

            <li class="nav-item w-100">
                <a class="nav-link"  href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fe fe fe-log-out  fe-16"></i>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                    <span class="{{ $isRtl ? 'ml-3' : 'mr-3' }} item-text">{{ __('dashboard.logout') }}</span>
                </a>
            </li>
        </ul>
    </nav>
</aside>

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
        // Global SweetAlert configuration based on language
        @if($isRtl)
        window.Swal = Swal.mixin({
            confirmButtonText: 'موافق',
            cancelButtonText: 'إلغاء',
            confirmButtonColor: '#007bff',
            cancelButtonColor: '#6c757d'
        });
        @else
        window.Swal = Swal.mixin({
            confirmButtonText: 'Confirm',
            cancelButtonText: 'Cancel',
            confirmButtonColor: '#007bff',
            cancelButtonColor: '#6c757d'
        });
        @endif

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
