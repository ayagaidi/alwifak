<!doctype html>
<html lang="ar" dir="rtl">
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
        <nav class="topnav navbar navbar-light">
    <button type="button" class="navbar-toggler text-muted mt-2 p-0 mr-3 collapseSidebar">
        <i class="fe fe-menu navbar-toggler-icon"></i>
    </button>
    <form class="form-inline mr-auto searchform text-muted">
        <input class="form-control mr-sm-2 bg-transparent border-0 pl-4 text-muted" type="search" placeholder="البحث..." aria-label="Search">
    </form>
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link text-muted my-2" href="#" id="modeSwitcher" data-mode="light">
                <i class="fe fe-sun fe-16"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-muted my-2" href="./#" data-toggle="modal" data-target=".modal-shortcut">
                <span class="fe fe-grid fe-16"></span>
            </a>
        </li>
        <li class="nav-item nav-notif">
            <a class="nav-link text-muted my-2" href="./#" data-toggle="modal" data-target=".modal-notif">
                <span class="fe fe-bell fe-16"></span>
                <span class="dot dot-md bg-success"></span>
            </a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-muted pr-0" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="avatar avatar-sm mt-2">
                    <img src="{{ asset('light-rtl/assets/avatars/face-1.jpg') }}" alt="..." class="avatar-img rounded-circle">
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="#">الملف الشخصي</a>
                <a class="dropdown-item" href="#">الإعدادات</a>
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">تسجيل الخروج</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </li>
    </ul>
</nav>

<!-- Sidebar -->
<aside class="sidebar-left border-right bg-white shadow" id="leftSidebar" data-simplebar>
    <a href="#" class="btn collapseSidebar toggle-btn d-lg-none text-muted ml-2 mt-3" data-toggle="toggle">
        <i class="fe fe-x"><span class="sr-only"></span></i>
    </a>
    <nav class="vertnav navbar navbar-light">
        <div class="w-100 mb-4 d-flex">
            <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="{{ url('/') }}">
                <img src="{{ asset('logo.png') }}" alt="Logo" class="navbar-brand-img brand-sm" style="max-height: 40px;">
            </a>
        </div>
        <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item w-100">
                <a class="nav-link active" href="{{ route('dashboard') }}">
                    <i class="fe fe-home fe-16"></i>
                    <span class="ml-3 item-text">لوحة التحكم</span>
                </a>
            </li>

           

            <li class="nav-item w-100">
                <a class="nav-link" href="{{ route('users.index') }}">
                    <i class="fe fe-users fe-16"></i>
                    <span class="ml-3 item-text">إدارة المستخدمين</span>
                </a>
            </li>
            <li class="nav-item w-100">
                <a class="nav-link" href="{{ route('customers.index') }}">
                    <i class="fe fe-user fe-16"></i>
                    <span class="ml-3 item-text">إدارة العملاء</span>
                </a>
            </li>
            <li class="nav-item w-100">
                <a class="nav-link" href="{{ route('services.index') }}">
                    <i class="fe fe-briefcase fe-16"></i>
                    <span class="ml-3 item-text">إدارة الخدمات</span>
                </a>
            </li>

            <li class="nav-item w-100">
                <a class="nav-link" href="#">
                    <i class="fe fe-settings fe-16"></i>
                    <span class="ml-3 item-text">الإعدادات</span>
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
    </script>
</body>
</html>
