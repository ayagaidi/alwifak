<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ config('app.name', 'WebFlux') }} - @yield('title', 'Home')</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
           <link rel="icon" href="{{ asset('logo.ico') }}">

      <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ asset('webflux/assets/images/favicon/ms-icon-144x144.png') }}">
    <meta name="theme-color" content="#ffffff">
    <!-- Font Awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- StyleSheet link CSS -->
    <link rel="stylesheet" href="{{ asset('webflux/assets/css/animate.css') }}">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="{{ asset('webflux/assets/bootstrap/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('webflux/assets/css/superclasses.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('webflux/assets/css/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('webflux/assets/css/owl.theme.default.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('webflux/assets/css/custom.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('webflux/assets/css/shop.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('webflux/assets/css/responsive.css') }}" type="text/css">

    @stack('styles')
</head>

<body class="index2-outer-wrapper">
    <!-- LOADER -->
    <div class="loader-mask">
        <div class="loader">
            <div></div>
            <div></div>
        </div>
    </div>
    <!-- OUTER BG WRAPPER -->
    <div class="sub-outer-wrapper position-relative float-left w-100 home2-banner">
        <figure><img src="{{ asset('webflux/assets/images/home02/ellipse.png') }}" alt="object" class="img-fluid object position-absolute">
        </figure>
        <!-- HEADER SECTION -->
        <header class="w-100 flaot-left header-con position-relative main-box">
            <div class="container">
                <nav class="navbar navbar-expand-lg navbar-light p-0">
                    <button class="navbar-toggler collapsed" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                        <span class="navbar-toggler-icon"></span>
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <figure class="mb-0">
                            <img src="{{ asset('logo.svg') }}" alt="logo-icon" class="img-fluid">
                        </figure>
                    </a>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto">
                             <li class="nav-item active" >
                                <a class="nav-link p-0" href="{{ url('/') }}">home</a>
                            </li>
                              <li class="nav-item" active>
                                <a class="nav-link p-0" href="{{ route('about') }}">About</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle p-0" href="#" id="navbarDropdown3" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Services
                                </a>
                                <div class="dropdown-menu custom-dropdown" aria-labelledby="navbarDropdown3">
                                    <ul class="list-unstyled mb-0">
                                        <li><a href="{{ route('about') }}"><i class="fa-solid fa-check"></i> About</a></li>
                                        <li><a href="{{ route('contact') }}"><i class="fa-solid fa-check"></i> Contact</a></li>
                                        <li><a href="{{ route('pricing') }}"><i class="fa-solid fa-check"></i> Pricing</a></li>
                                        <li><a href="{{ route('project') }}"><i class="fa-solid fa-check"></i> Projects</a></li>
                                        <li><a href="{{ route('service') }}"><i class="fa-solid fa-check"></i> Services</a></li>
                                        <li><a href="{{ route('team') }}"><i class="fa-solid fa-check"></i> Team</a></li>
                                        <li><a href="{{ route('testimonial') }}"><i class="fa-solid fa-check"></i> Testimonial</a></li>
                                        <li><a href="{{ route('cart') }}"><i class="fa-solid fa-check"></i> Cart</a></li>
                                        <li><a href="{{ route('checkout') }}"><i class="fa-solid fa-check"></i> Checkout</a></li>
                                        <li><a href="{{ route('product-detail') }}"><i class="fa-solid fa-check"></i> Product Detail</a></li>
                                        <li><a href="{{ route('shop') }}"><i class="fa-solid fa-check"></i> Shop</a></li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle p-0" href="{{ route('blog') }}" id="navbarDropdown4" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Blog</a>
                                <div class="dropdown-menu custom-dropdown" aria-labelledby="navbarDropdown4">
                                    <ul class="list-unstyled mb-0">
                                        <li> <a class="dropdown-item" href="{{ route('blog') }}"><i class="fa-solid fa-check"></i> Blog</a></li>
                                        <li> <a class="dropdown-item" href="{{ route('load-more') }}"><i class="fa-solid fa-check"></i> Load More</a>
                                        </li>
                                        <li> <a class="dropdown-item" href="{{ route('single-blog') }}"><i class="fa-solid fa-check"></i> Single
                                            Blog</a></li>
                                        <li> <a class="dropdown-item" href="{{ route('one-column') }}"><i class="fa-solid fa-check"></i> One
                                            Column</a>
                                        </li>
                                        <li> <a class="dropdown-item" href="{{ route('two-column') }}"><i class="fa-solid fa-check"></i> Two
                                            Column</a>
                                        </li>
                                        <li> <a class="dropdown-item" href="{{ route('three-column') }}"><i class="fa-solid fa-check"></i> Three
                                            Column</a></li>
                                        <li><a class="dropdown-item" href="{{ route('three-colum-sidbar') }}"> <i class="fa-solid fa-check"></i> Three
                                            Column Sidbar</a></li>
                                        <li><a class="dropdown-item" href="{{ route('four-column') }}"><i class="fa-solid fa-check"></i> Four
                                            Column</a>
                                        </li>
                                        <li><a class="dropdown-item" href="{{ route('six-colum-full-wide') }}"><i class="fa-solid fa-check"></i> Six
                                            Column</a></li>
                                    </ul>
                                </div>
                            </li>
                              <li class="nav-item">
                                <a class="nav-link p-0" href="{{ route('blog') }}">Blog</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link p-0" href="{{ route('contact') }}">Contact</a>
                            </li>
                        </ul>
                    </div>
                    <div class="header-btn">
                        <ul class="list-unstyled mb-0">
                            <li>
                                <div class="sign-btn">
                                    <a href="{{ route('contact') }}">Live Chat</a>
                                </div>
                            </li>
                           
                            <li>
                                <div class="search-bar">
                                    <a href="#search">
                                        <img src="{{ asset('webflux/assets/images/search-icon.png') }}" alt="search-icon">
                                    </a>
                                </div>
                            </li>
                            <li>
                                <div class="toggle-bar">
                                    <a href="#" class="drawer-button" title="View cart">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
                <!-- container -->
            </div>
            <!-- header-con -->
        </header>
        <div class="clearfix"></div>
        <!-- DRAWER MENU -->
        <aside id="sidebar-drawer" aria-label="sidebar-drawer">
            <a href="#" class="close-button"><span class="close-icon"><i class="fas fa-times"></i></span></a>
            <div class="drawer-menu-logo" style="text-align: center;">
                <a href="{{ url('/') }}">
                    <figure class="mb-0">
                        <img src="{{ asset('logo.svg') }}" alt="logo-icon" style="max-height: 60px;" class="img-fluid">
                    </figure>
                </a>
            </div>
            <div class="drawer-hosting-box">
                <ul class="list-unstyled mb-0">
                    <li>
                        <a href="{{ route('domain') }}">
                            <figure class="mb-0">
                                <img src="{{ asset('webflux/assets/images/feature-icon1.png') }}" alt="mega-hosting-icon">
                            </figure>
                            <div class="drawer-hosting-contant">
                                <h5>Web Hosting</h5>
                                <span class="d-block">Choose Your Hosting Plan</span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('reseller') }}">
                            <figure class="mb-0">
                                <img src="{{ asset('webflux/assets/images/feature-icon2.png') }}" alt="mega-hosting-icon">
                            </figure>
                            <div class="drawer-hosting-contant">
                                <h5>Reseller Hosting</h5>
                                <span class="d-block">Choose Your Hosting Plan</span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('shared') }}">
                            <figure class="mb-0">
                                <img src="{{ asset('webflux/assets/images/feature-icon3.png') }}" alt="shared-hosting-icon">
                            </figure>
                            <div class="drawer-hosting-contant">
                                <h5>Shared Hosting</h5>
                                <span class="d-block">Choose Your Hosting Plan</span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('vps') }}">
                            <figure class="mb-0">
                                <img src="{{ asset('webflux/assets/images/feature-icon4.png') }}" alt="mega-hosting-icon">
                            </figure>
                            <div class="drawer-hosting-contant">
                                <h5>Virtual Private Server</h5>
                                <span class="d-block">Choose Your Hosting Plan</span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('dedicated') }}">
                            <figure class="mb-0">
                                <img src="{{ asset('webflux/assets/images/feature-icon5.png') }}" alt="mega-hosting-icon">
                            </figure>
                            <div class="drawer-hosting-contant">
                                <h5>Dedicated Server</h5>
                                <span class="d-block">Choose Your Hosting Plan</span>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </aside>
        <div id="sidebar-drawer-curtain"></div>
        <!-- DRAWER MENU -->
        <!-- SEARCH BAR -->
        <div id="search" class="">
            <span class="close">X</span>
            <form role="search" id="searchform" method="get" action="{{ route('search') }}">
                <input value="" name="q" type="search" placeholder="Type to Search">
            </form>
        </div>

        @yield('content')

        <!-- FOOTER SECTION -->
        <section class="float-left w-100 position-relative footer-con main-box background-11151c">
            <div class="container">
                <div class="middle-portion">
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-sm-6 col-12 order-0">
                            <div class="first-column" style="color: white !important;">
                                <a href="{{ url('/') }}">
                                    <figure class="footer-logo">
                                        <img src="{{ asset('logo.svg') }}" class="img-fluid" alt="">
                                    </figure>
                                </a>
                                <p class=" footer-text">Grursus mal suada faci lisis lorem ipsum dolaror
                                    more ameion consectetur elit vesti at bulum ne odio aea the dumm ipsum dolocons.</p>
                                <div class="lower">
                                    <div class="lower-content">
                                        <figure class="icon">
                                            <img src="{{ asset('webflux/assets/images/nav-phoneimage.png') }}" alt="" class="img-fluid">
                                        </figure>
                                        <div class="content">
                                            <span class="text-white">Call us:</span>
                                            <a class=" mb-0 text text-decoration-none" href="tel:+6138376284">+61 3 837 6284</a>
                                        </div>
                                    </div>
                                    <div class="lower-content">
                                        <figure class="icon">
                                            <img src="{{ asset('webflux/assets/images/footer-emailicon.png') }}" alt="" class="img-fluid">
                                        </figure>
                                        <div class="content">
                                            <span class="text-white">Email us:</span>
                                            <a href="mailto:Info@webflux.com" class=" mb-0 text-decoration-none">Info@webflux.com</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-6 col-sm-6 col-12 order-xl-1 order-lg-1 order-2">
                            <div class="links list-pd">
                                <h5 class="heading text-white">Quick Links</h5>
                                <ul class="list-unstyled mb-0">
                                    <li class="position-relative"><i class="fa-solid fa-circle"></i><a href="{{ url('/') }}"
                                        class=" text text-decoration-none">Home</a></li>
                                    <li class="position-relative"><i class="fa-solid fa-circle"></i><a href="{{ route('about') }}"
                                        class="d-inline-block">About Us</a></li>
                                    <li class="position-relative"><i class="fa-solid fa-circle"></i><a href="{{ route('service') }}"
                                        class=" text text-decoration-none">Services</a>
                                    </li>
                                    <li class="position-relative"><i class="fa-solid fa-circle"></i><a href="{{ route('single-blog') }}"
                                        class=" text text-decoration-none">Blog</a>
                                    </li>
                                    <li class="position-relative"><i class="fa-solid fa-circle"></i><a href="{{ route('contact') }}"
                                        class=" text text-decoration-none">Contact</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-6 col-sm-6 col-12 pr-0 order-xl-2 order-lg-2 order-3">
                            <div class="links var2">
                                <h5 class="heading text-white">Our Services</h5>
                                <ul class="list-unstyled mb-0">
                                    <li class="position-relative"><i class="fa-solid fa-circle"></i><a href="{{ route('service') }}"
                                        class=" text text-decoration-none">Cloud
                                        Service</a></li>
                                    <li class="position-relative"><i class="fa-solid fa-circle"></i><a href="{{ route('testimonial') }}"
                                        class="text text-decoration-none">Testimonial</a></li>
                                    <li class="position-relative"><i class="fa-solid fa-circle"></i><a href="{{ route('team') }}"
                                        class="text text-decoration-none">Team</a></li>
                                    <li class="position-relative"><i class="fa-solid fa-circle"></i><a href="{{ route('project') }}"
                                        class="text text-decoration-none">Digital
                                        marketing</a></li>
                                    <li class="position-relative"><i class="fa-solid fa-circle"></i><a href="{{ route('pricing') }}"
                                        class="text text-decoration-none">Pricing</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6 col-12 order-xl-3 order-lg-3 order-1 ">
                            <div class="icons">
                                <h5 class="heading text-white">Subscribe Newsletter</h5>
                                <form action="{{ route('newsletter.subscribe') }}" method="POST">
                                    @csrf
                                    <div class="form-group mb-0 position-relative">
                                        <input type="email" class="form_style" placeholder="Email" name="email" required>
                                        <button type="submit"><i class="fa-solid fa-arrow-right"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="copyright float-left w-100 position-relative">
                    <div class="container">
                        <div class="row copyright-border mb-0">
                            <div class="col-lg-6 col-md-6 col-sm-12 co-12 column">
                                <p class="text-size-16">Copyright ©{{ date('Y') }} <a class="d-inline-block blue-text" href="{{ url('/') }}">{{ config('app.name', 'WebFlux') }}</a>
                                    All Rights
                                    Reserved
                                </p>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 co-12">
                                <div class="social-icons position-relative">
                                    <ul class="list-unstyled position-absolute">
                                        <li><a href="https://www.facebook.com/" class="text-decoration-none"><i
                                                class="fa-brands fa-facebook-f social-networks"></i></a></li>
                                        <li><a href="https://twitter.com/" class="text-decoration-none"><i
                                                class="fa-brands fa-twitter social-networks"></i></a>
                                        </li>
                                        <li><a href="https://www.google.co.uk/" class="text-decoration-none"><i
                                                class="fa-brands fa-google-plus-g social-networks"></i></a></li>
                                        <li><a href="https://www.instagram.com/" class="text-decoration-none"><i
                                                class="fa-brands fa-instagram social-networks"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- container -->
            </div>
            <!-- footer con -->
        </section>

        <!-- Latest compiled JavaScript -->
     
        <!-- BACK TO TOP BUTTON -->
        <button id="back-to-top-btn" title="Back to Top"></button>
        <script src="{{ asset('webflux/assets/js/jquery.min.js') }}"></script>
        <script src="{{ asset('webflux/assets/js/popper.min.js') }}"></script>
        <script src="{{ asset('webflux/assets/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('webflux/assets/js/drawer-menu.js') }}"></script>
        <script src="{{ asset('webflux/assets/js/owl.carousel.js') }}"></script>
        <script src="{{ asset('webflux/assets/js/contact-form.js') }}"></script>
        <script src="{{ asset('webflux/assets/js/video-popup.js') }}"></script>
        <script src="{{ asset('webflux/assets/js/video-section.js') }}"></script>
        <script src="{{ asset('webflux/assets/js/jquery.validate.js') }}"></script>
        <script src="{{ asset('webflux/assets/js/wow.js') }}"></script>
        <script src="{{ asset('webflux/assets/js/counter.js') }}"></script>
        <script src="{{ asset('webflux/assets/js/custom.js') }}"></script>
        <script src="{{ asset('webflux/assets/js/search.js') }}"></script>
        <script src="{{ asset('webflux/assets/js/shop.js') }}"></script>
        <script src="{{ asset('webflux/assets/js/remove-product.js') }}"></script>
        <script src="{{ asset('webflux/assets/js/quantity.js') }}"></script>

        @stack('scripts')
    </div>
</body>

</html>
