@extends('front.app')

@section('title', 'About Us')

@section('content')
<!-- BANNER SECTION -->
<section class="float-left w-100 position-relative sub-banner-con main-box">
    <div class="container">
        <div class="row align-items-end">
            <div class="col-lg-6 col-md-8">
                <div class="sub-bannr-content-con">
                    <h1>About Us</h1>
                    <p class="mb-0 text-white">We craft cutting-edge digital experiences that elevate your brand, engage your
                        audience, and drive
                        results. </p>
                    <!-- sub banner conntent con -->
                </div>
                <!-- col -->
            </div>
            <div class="col-lg-6 col-md-4">
                <div class="sub-banner-right-con text-right">
                    <div class="breadcrumb-con d-inline-block">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">About</li>
                        </ol>
                        <!-- breadcrumb -->
                    </div>
                    <!-- sub banner right con -->
                </div>
                <!-- col -->
            </div>

            <!-- row -->
        </div>
        <!-- container -->
    </div>
    <!-- sub banner con -->
</section>

<!-- ABOUT US INFO SECTION -->
<section class="float-left w-100 position-relative about-us-info-con padding-top padding-bottom main-box">
    <div class="container wow fadeIn" data-wow-duration="2s" data-wow-delay="0.3s">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-6">
                <div class="about-info-img-con position-relative">
                    <figure><img src="{{ asset('webflux/assets/images/blue-rounded-rectangle-box.png') }}" alt="image"
                        class="img-fluid position-absolute border-0 rounded-box"></figure>
                    <figure><img src="{{ asset('webflux/assets/images/about-us-info-img.jpg') }}" alt="image"
                        class="img-fluid position-relative z-index-1 about-main-img"></figure>
                    <div class="white-box-con position-absolute text-center">
                        <img src="{{ asset('webflux/assets/images/info-icon.png') }}" alt="icon" class="img-fluid d-block">
                        <span class="d-inline-block black-family-text counter font-weight-800 outfit-font">30 </span> <sup
                            class="d-inline-block blue-text font-weight-800 outfit-font">+</sup>
                        <span class="span-text d-block inter-font">Years of Experience</span>
                        <!-- white box con -->
                    </div>
                    <!-- about info img con -->
                </div>

                <!-- col -->
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="about-us-info-content">
                    <div class="heading-title-con mb-0">
                        <span class="d-block special-text blue-text inter-font font-weight-normal">About Us </span>
                        <h2 class="black-family-text position-relative">Creative Digital <br>
                            Experience Company</h2>

                        <p class="">Quis autem vel eum iure reprehenderit rui in ea volurate veli
                            esse ruam nihil molestiae conseauatur vel illum rui dolorema
                            eum fugiat ruo voluetas nulla pariatur.</p>
                        <ul class="list-unstyled p-0">
                            <li class="position-relative black-family-text outfit-font font-weight-500"><i
                                class="fa-regular fa-circle-check"></i>Excepteur sint occaecat cupidatat noru even.</li>
                            <li class="position-relative black-family-text outfit-font font-weight-500"><i
                                class="fa-regular fa-circle-check"></i> Duis aute irure dolor in reprehenderit in voluta facis.
                            </li>
                            <li class="position-relative black-family-text outfit-font font-weight-500"><i
                                class="fa-regular fa-circle-check"></i>Rerum hic tenetur a sapiente delectus au occae.</li>
                            <!-- listing -->
                        </ul>
                        <div class="primary-button d-inline-block">
                            <a href="{{ route('contact') }}" class="d-inline-block">Get Started <i
                                class="fa-solid fa-arrow-right ml-2"></i></a>
                        </div>
                        <!-- heading title con -->
                    </div>
                    <!-- about us info content -->
                </div>
                <!-- col -->
            </div>
            <!-- row -->
        </div>
        <!-- container -->
    </div>
    <!-- about us info con -->
</section>

<!-- FUN FACTS SECTION -->
<section
    class="float-left w-100 fun-facts-con position-relative padding-top padding-bottom main-box background-f4f5ff">
    <figure><img src="{{ asset('webflux/assets/images/design-element.png') }}" alt="element"
        class="img-fluid position-absolute design-element"></figure>
    <div class="container wow fadeInUp" data-wow-duration="2s" data-wow-delay="0.3s">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-6">
                <div class="fun-facts-content">
                    <div class="heading-title-con mb-0">
                        <span class="d-block special-text blue-text inter-font font-weight-normal">Funfacts </span>
                        <h2 class="black-family-text position-relative">We Are Team Of Passionate
                            Digital Experts</h2>
                        <!-- heading title con -->
                    </div>
                    <div class="row fun-inner-row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="fact-box">
                                <figure><img src="{{ asset('webflux/assets/images/fun-fact-icon1.png') }}" alt="icon" class="img-fluid"></figure>
                                <span class="d-inline-block black-family-text counter font-weight-800 outfit-font">2975 </span> <sup
                                    class="d-inline-block blue-text font-weight-800 outfit-font">+</sup>
                                <span class="span-text d-block inter-font">Business Ideas</span>
                                <!-- fact box -->
                            </div>
                            <!-- col -->
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="fact-box">
                                <figure><img src="{{ asset('webflux/assets/images/fun-fact-icon2.png') }}" alt="icon" class="img-fluid"></figure>
                                <span class="d-inline-block black-family-text counter font-weight-800 outfit-font">3345 </span> <sup
                                    class="d-inline-block blue-text font-weight-800 outfit-font">+</sup>
                                <span class="span-text d-block inter-font">Happy Customers</span>
                                <!-- fact box -->
                            </div>
                            <!-- col -->
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="fact-box">
                                <figure><img src="{{ asset('webflux/assets/images/fun-fact-icon3.png') }}" alt="icon" class="img-fluid"></figure>
                                <span class="d-inline-block black-family-text counter font-weight-800 outfit-font">1050 </span> <sup
                                    class="d-inline-block blue-text font-weight-800 outfit-font">+</sup>
                                <span class="span-text d-block inter-font">Media Posts</span>
                                <!-- fact box -->
                            </div>
                            <!-- col -->
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="fact-box">
                                <figure><img src="{{ asset('webflux/assets/images/fun-fact-icon4.png') }}" alt="icon" class="img-fluid"></figure>
                                <span class="d-inline-block black-family-text counter font-weight-800 outfit-font">7456 </span> <sup
                                    class="d-inline-block blue-text font-weight-800 outfit-font">+</sup>
                                <span class="span-text d-block inter-font">Finished Projects</span>
                                <!-- fact box -->
                            </div>
                            <!-- col -->
                        </div>
                        <!-- row -->
                    </div>
                    <!-- fun facts content -->
                </div>
                <!-- col -->
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="fun-fact-img-con position-relative">
                    <figure><img src="{{ asset('webflux/assets/images/fun-fact-img.jpg') }}" alt="image" class="img-fluid position-relative z-index-1">
                    </figure>
                    <figure><img src="{{ asset('webflux/assets/images/blue-rounded-rectangle-box2.png') }}" alt="image"
                        class="img-fluid position-absolute blue-rounded-box"></figure>
                    <!-- fun fact img con -->
                </div>
                <!-- col -->
            </div>
            <!-- row -->
        </div>

        <!-- container -->
    </div>
    <!-- fun facts -->
</section>

<!-- OUR EXPERTISE SECTION -->
<section class="float-left w-100 position-relative expertise-con padding-top padding-bottom main-box border-wrap">
    <div class="container-fluid wow fadeIn" data-wow-duration="2s" data-wow-delay="0.3s">
        <div class="row">
            <div class="col-lg-3 col-md-12 col-sm-12 col-12 d-lg-block d-none">
                <!-- col -->
            </div>
            <div class="col-lg-9 col-md-12 col-sm-12 col-12">
                <div class="row">
                    <div class="col-lg-3 iner-col3 col-md-4">
                        <div class="world-class-box">
                            <span class="d-block">Our Expertise</span>
                            <h2>Provide World <br>
                                Class Services</h2>
                            <img src="{{ asset('webflux/assets/images/white-line.png') }}" alt="icon" class="img-fluid white-line">
                            <p class="">Reprehenderit rui in ea volurate
                                esse ruam nihil mole.</p>
                            <div class="primary-button d-inline-block">
                                <a href="{{ route('service') }}" class="d-inline-block">View All Services <i
                                    class="fa-solid fa-arrow-right ml-2"></i></a>
                            </div>
                            <!-- world class box -->
                        </div>
                        <!-- col -->
                    </div>
                    <div class="col-lg-9 inner-col col-md-8">
                        <div class="owl-carousel owl-theme">
                            <div class="item">
                                <div class="outclass-service-box">
                                    <figure><img src="{{ asset('webflux/assets/images/outclass-icon1.png') }}" alt="icon" class="img-fluid"></figure>
                                    <h4>Web Designing <br>
                                        Services</h4>
                                    <p>Molestiae non recusandae Itaue eau
                                        em rerum hic tenetur a sapiente delec
                                        aut reiciendis volupt.</p>
                                    <a href="{{ route('service') }}" class="d-inline-block">Read More <i
                                        class="fa-solid fa-arrow-right ml-2"></i></a>
                                    <!-- outclass service box -->
                                </div>
                                <!-- item -->
                            </div>
                            <div class="item">
                                <div class="outclass-service-box">
                                    <figure><img src="{{ asset('webflux/assets/images/outclass-icon2.png') }}" alt="icon" class="img-fluid"></figure>
                                    <h4>Web Development <br>
                                        Services</h4>
                                    <p>Molestiae non recusandae Itaue eau
                                        em rerum hic tenetur a sapiente delec
                                        aut reiciendis volupt.</p>
                                    <a href="{{ route('service') }}" class="d-inline-block">Read More <i
                                        class="fa-solid fa-arrow-right ml-2"></i></a>
                                    <!-- outclass service box -->
                                </div>
                                <!-- item -->
                            </div>
                            <div class="item">
                                <div class="outclass-service-box">
                                    <figure><img src="{{ asset('webflux/assets/images/outclass-icon3.png') }}" alt="icon" class="img-fluid"></figure>
                                    <h4>Ui/Ux Design <br>
                                        Services</h4>
                                    <p>Molestiae non recusandae Itaue eau
                                        em rerum hic tenetur a sapiente delec
                                        aut reiciendis volupt.</p>
                                    <a href="{{ route('service') }}" class="d-inline-block">Read More <i
                                        class="fa-solid fa-arrow-right ml-2"></i></a>
                                    <!-- outclass service box -->
                                </div>
                                <!-- item -->
                            </div>
                            <!--  -->
                            <div class="item">
                                <div class="outclass-service-box">
                                    <figure><img src="{{ asset('webflux/assets/images/outclass-icon1.png') }}" alt="icon" class="img-fluid"></figure>
                                    <h4>Web Designing <br>
                                        Services</h4>
                                    <p>Molestiae non recusandae Itaue eau
                                        em rerum hic tenetur a sapiente delec
                                        aut reiciendis volupt.</p>
                                    <a href="{{ route('service') }}" class="d-inline-block">Read More <i
                                        class="fa-solid fa-arrow-right ml-2"></i></a>
                                    <!-- outclass service box -->
                                </div>
                                <!-- item -->
                            </div>
                            <div class="item">
                                <div class="outclass-service-box">
                                    <figure><img src="{{ asset('webflux/assets/images/outclass-icon2.png') }}" alt="icon" class="img-fluid"></figure>
                                    <h4>Web Development <br>
                                        Services</h4>
                                    <p>Molestiae non recusandae Itaue eau
                                        em rerum hic tenetur a sapiente delec
                                        aut reiciendis volupt.</p>
                                    <a href="{{ route('service') }}" class="d-inline-block">Read More <i
                                        class="fa-solid fa-arrow-right ml-2"></i></a>
                                    <!-- outclass service box -->
                                </div>
                                <!-- item -->
                            </div>
                            <div class="item">
                                <div class="outclass-service-box">
                                    <figure><img src="{{ asset('webflux/assets/images/outclass-icon3.png') }}" alt="icon" class="img-fluid"></figure>
                                    <h4>Ui/Ux Design <br>
                                        Services</h4>
                                    <p>Molestiae non recusandae Itaue eau
                                        em rerum hic tenetur a sapiente delec
                                        aut reiciendis volupt.</p>
                                    <a href="{{ route('service') }}" class="d-inline-block">Read More <i
                                        class="fa-solid fa-arrow-right ml-2"></i></a>
                                    <!-- outclass service box -->
                                </div>
                                <!-- item -->
                            </div>
                            <!--  -->
                            <div class="item">
                                <div class="outclass-service-box">
                                    <figure><img src="{{ asset('webflux/assets/images/outclass-icon1.png') }}" alt="icon" class="img-fluid"></figure>
                                    <h4>Web Designing <br>
                                        Services</h4>
                                    <p>Molestiae non recusandae Itaue eau
                                        em rerum hic tenetur a sapiente delec
                                        aut reiciendis volupt.</p>
                                    <a href="{{ route('service') }}" class="d-inline-block">Read More <i
                                        class="fa-solid fa-arrow-right ml-2"></i></a>
                                    <!-- outclass service box -->
                                </div>
                                <!-- item -->
                            </div>
                            <div class="item">
                                <div class="outclass-service-box">
                                    <figure><img src="{{ asset('webflux/assets/images/outclass-icon2.png') }}" alt="icon" class="img-fluid"></figure>
                                    <h4>Web Development <br>
                                        Services</h4>
                                    <p>Molestiae non recusandae Itaue eau
                                        em rerum hic tenetur a sapiente delec
                                        aut reiciendis volupt.</p>
                                    <a href="{{ route('service') }}" class="d-inline-block">Read More <i
                                        class="fa-solid fa-arrow-right ml-2"></i></a>
                                    <!-- outclass service box -->
                                </div>
                                <!-- item -->
                            </div>
                            <div class="item">
                                <div class="outclass-service-box">
                                    <figure><img src="{{ asset('webflux/assets/images/outclass-icon3.png') }}" alt="icon" class="img-fluid"></figure>
                                    <h4>Ui/Ux Design <br>
                                        Services</h4>
                                    <p>Molestiae non recusandae Itaue eau
                                        em rerum hic tenetur a sapiente delec
                                        aut reiciendis volupt.</p>
                                    <a href="{{ route('service') }}" class="d-inline-block">Read More <i
                                        class="fa-solid fa-arrow-right ml-2"></i></a>
                                    <!-- outclass service box -->
                                </div>
                                <!-- item -->
                            </div>
                            <!-- owl carousel -->
                        </div>
                        <!-- col -->
                    </div>
                    <!-- row -->
                </div>
                <!-- col 9 -->
            </div>
            <!-- row -->
        </div>
        <!-- container fluid -->
    </div>
    <!-- our expertise con -->
</section>

<!-- TEAM MEMBERS SECTION -->
<section
    class="float-left w-100 position-relative team-members-con padding-top padding-bottom main-box background-f4f5ff">
    <figure><img src="{{ asset('webflux/assets/images/vector6.png') }}" alt="vector6" class="img-fluid vector6 position-absolute"></figure>
    <div class="container wow fadeInUp" data-wow-duration="2s" data-wow-delay="0.3s">
        <div class="heading-title-con text-center">
            <span class="d-block special-text blue-text inter-font font-weight-light">Expert people </span>
            <h2 class="black-family-text">Our Professional Team Members</h2>
            <p class="mb-0">Grursus mal suada faci lisis lorem ipsum dolarorit more ame ion consectetur elit vesti at <br>
                odio aea the dumm recreo that dolocons.</p>
            <!-- heading title con -->
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 d-flex">
                <div class="team-box w-100 text-center">
                    <figure><img src="{{ asset('webflux/assets/images/team-member-img1.jpg') }}" alt="image" class="img-fluid"></figure>
                    <div class="content-box">
                        <h4 c lass="black-family-text">David Bell</h4>
                        <span class="d-block inter-font">Marketer</span>
                        <ul class="list-unstyled p-0 m-0 d-flex align-items-center justify-content-center social-icon mb-0">
                            <li><a href="https://www.facebook.com/login/" class="ml-0 d-block"><i
                                class="fa-brands fa-facebook-f ml-0"></i></a></li>
                            <li><a href="https://twitter.com/i/flow/login" class="d-block"><i
                                class="fa-brands fa-x-twitter"></i></a></li>
                            <li><a href="https://www.instagram.com/" class="mr-0 d-block"><i
                                class="fa-brands fa-youtube mr-0"></i></a></li>
                        </ul>
                        <!-- content -->
                    </div>
                    <!-- team box -->
                </div>
                <!-- col -->
            </div>
            <div class="col-lg-3 col-md-6 d-flex">
                <div class="team-box w-100 text-center">
                    <figure><img src="{{ asset('webflux/assets/images/team-member-img2.jpg') }}" alt="image" class="img-fluid"></figure>
                    <div class="content-box">
                        <h4 class="black-family-text">Kevin Woods</h4>
                        <span class="d-block inter-font">Developer</span>
                        <ul class="list-unstyled p-0 m-0 d-flex align-items-center justify-content-center social-icon mb-0">
                            <li><a href="https://www.facebook.com/login/" class="ml-0 d-block"><i
                                class="fa-brands fa-facebook-f ml-0"></i></a></li>
                            <li><a href="https://twitter.com/i/flow/login" class="d-block"><i
                                class="fa-brands fa-x-twitter"></i></a></li>
                            <li><a href="https://www.instagram.com/" class="mr-0 d-block"><i
                                class="fa-brands fa-youtube mr-0"></i></a></li>
                        </ul>
                        <!-- content -->
                    </div>
                    <!-- team box -->
                </div>
                <!-- col -->
            </div>
            <div class="col-lg-3 col-md-6 d-flex">
                <div class="team-box w-100 text-center">
                    <figure><img src="{{ asset('webflux/assets/images/team-member-img3.jpg') }}" alt="image" class="img-fluid"></figure>
                    <div class="content-box">
                        <h4 class="black-family-text">Georgia James</h4>
                        <span class="d-block inter-font">Developer</span>
                        <ul class="list-unstyled p-0 m-0 d-flex align-items-center justify-content-center social-icon mb-0">
                            <li><a href="https://www.facebook.com/login/" class="ml-0 d-block"><i
                                class="fa-brands fa-facebook-f ml-0"></i></a></li>
                            <li><a href="https://twitter.com/i/flow/login" class="d-block"><i
                                class="fa-brands fa-x-twitter"></i></a></li>
                            <li><a href="https://www.instagram.com/" class="mr-0 d-block"><i
                                class="fa-brands fa-youtube mr-0"></i></a></li>
                        </ul>
                        <!-- content -->
                    </div>
                    <!-- team box -->
                </div>
                <!-- col -->
            </div>
            <div class="col-lg-3 col-md-6 d-flex">
                <div class="team-box w-100 text-center">
                    <figure><img src="{{ asset('webflux/assets/images/team-member-img4.jpg') }}" alt="image" class="img-fluid"></figure>
                    <div class="content-box">
                        <h4 class="black-family-text">Alina James</h4>
                        <span class="d-block inter-font">Designer</span>
                        <ul class="list-unstyled p-0 m-0 d-flex align-items-center justify-content-center social-icon mb-0">
                            <li><a href="https://www.facebook.com/login/" class="ml-0 d-block"><i
                                class="fa-brands fa-facebook-f ml-0"></i></a></li>
                            <li><a href="https://twitter.com/i/flow/login" class="d-block"><i
                                class="fa-brands fa-x-twitter"></i></a></li>
                            <li><a href="https://www.instagram.com/" class="mr-0 d-block"><i
                                class="fa-brands fa-youtube mr-0"></i></a></li>
                        </ul>
                        <!-- content -->
                    </div>
                    <!-- team box -->
                </div>
                <!-- col -->
            </div>
            <!-- row -->
        </div>
        <!-- container -->
    </div>
</section>
<!-- PROJECT TESTIMONIALS SECTION -->
<section class="float-left w-100 position-relative padding-top padding-bottom main-box project-testimonial-con">
    <figure><img src="{{ asset('webflux/assets/images/vector1.png') }}" alt="vector" class="img-fluid position-absolute vector1"></figure>
    <figure><img src="{{ asset('webflux/assets/images/vector2.png') }}" alt="vector" class="img-fluid position-absolute vector2"></figure>
    <div class="container wow fadeIn" data-wow-duration="2s" data-wow-delay="0.3s">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-12">
                <div class="testimonials-img-con position-relative text-left">
                    <figure class="text-center testimonial-quote-img">
                        <img src="{{ asset('webflux/assets/images/project-customer1.png') }}" alt="image" class="img-fluid">
                    </figure>
                    <img class="position-absolute img-fluid customer1" src="{{ asset('webflux/assets/images/customer-img1.png') }}" alt="image">
                    <img class="position-absolute img-fluid customer2" src="{{ asset('webflux/assets/images/customer-img2.png') }}" alt="image">
                    <img class="position-absolute img-fluid customer3" src="{{ asset('webflux/assets/images/customer-img3.png') }}" alt="image">
                    <img class="position-absolute img-fluid customer4" src="{{ asset('webflux/assets/images/customer-img4.png') }}" alt="image">
                    <!-- testimonial img con -->
                </div>
                <!-- col -->
            </div>
            <div class="col-lg-6 col-md-12">
                <!-- OWL CAROUSEL -->
                <div class="owl-carousel owl-theme">
                    <div class="item">
                        <div class="project-testimonial-content-con">
                            <div class="heading-title-con mb-0">
                                <span class="d-block special-text blue-text inter-font font-weight-light">Testimonials </span>
                                <h2 class="black-family-text">What Our Customers <br>
                                    Have to Say</h2>
                                <p class="">Nemo enim ipsam voluptatem quia voluptas sit asperna aut odit
                                    fugit, sed quia consequuntur magni dolores eos qui ratione volu
                                    sequi nesciuntporro quisuam est, rui dolorem ipsum quia dolor
                                    consectetur adieisci velit sed ruia.</p>
                                <!-- heading title con -->
                            </div>
                            <div class="review-content d-flex align-items-center">
                                <figure class="testimonial-personimage mb-0">
                                    <img src="{{ asset('webflux/assets/images/project-quote-icon.png') }}" alt="image" class="">
                                </figure>
                                <div class="detail">
                                    <span class="name">Kevin James</span>
                                    <span class="position">Happy Client</span>
                                    <!-- detail -->
                                </div>
                                <!-- review content -->
                            </div>
                            <!-- project testimonial content con -->
                        </div>
                        <!-- item -->
                    </div>
                    <div class="item">
                        <div class="project-testimonial-content-con">
                            <div class="heading-title-con mb-0">
                                <span class="d-block special-text blue-text inter-font font-weight-light">Testimonials </span>
                                <h2 class="black-family-text">What Our Customers <br>
                                    Have to Say</h2>
                                <p class="">Nemo enim ipsam voluptatem quia voluptas sit asperna aut odit
                                    fugit, sed quia consequuntur magni dolores eos qui ratione volu
                                    sequi nesciuntporro quisuam est, rui dolorem ipsum quia dolor
                                    consectetur adieisci velit sed ruia.</p>
                                <!-- heading title con -->
                            </div>
                            <div class="review-content d-flex align-items-center">
                                <figure class="testimonial-personimage mb-0">
                                    <img src="{{ asset('webflux/assets/images/project-quote-icon.png') }}" alt="image" class="">
                                </figure>
                                <div class="detail">
                                    <span class="name">Kevin James</span>
                                    <span class="position">Happy Client</span>
                                    <!-- detail -->
                                </div>
                                <!-- review content -->
                            </div>
                            <!-- project testimonial content con -->
                        </div>
                        <!-- item -->
                    </div>
                    <!-- owl carousel -->
                </div>
                <!-- col -->
            </div>
            <!-- row -->
        </div>
        <!-- container -->
    </div>
    <!-- project testimonial con -->
</section>
<!-- NEWS AND ARTICLES SECTION  -->
<section
    class="float-left w-100 position-relative padding-top padding-bottom news-and-articles-con main-box background-f4f5ff projects-news-articles-con">
    <div class="container wow fadeIn" data-wow-duration="2s" data-wow-delay="0.3s">
        <div class="heading-title-con text-center">
            <span class="d-block special-text blue-text inter-font font-weight-light">News and Articles </span>
            <h2 class="black-family-text">Our Latest Blog Posts</h2>
            <p class="mb-0">Grursus mal suada faci lisis lorem ipsum dolarorit more ame ion consectetur elit vesti at <br>
                odio aea the dumm recreo that dolocons.</p>
            <!-- heading title con -->
        </div>
        <div class="owl-carousel owl-theme">
            <div class="item">
                <div class="blog_boxcontent">
                    <div class="upper_portion">
                        <figure class="mb-0"><img src="{{ asset('webflux/assets/images/news-img1.jpg') }}" class="article_img" alt=""></figure>
                        <div class="image_content">
                            <div class="content">
                                <h3 class="text-white counter">18</h3>
                                <span class="text-white">March</span>
                            </div>
                        </div>
                    </div>
                    <div class="lower_portion_wrapper">
                            <div class="lower_portion">
                                <a href="{{ route('single-blog') }}">
                                    <h4>Useful Tips From Experts
                                        In Service.</h4>
                                </a>
                                <p class="text-size-18">Nostrum exercitationem aeullam
                                    corporis suscipit labo riosam aliruiea
                                    molestiae non recusandae...</p>
                                <a class="read_more text-decoration-none" href="{{ route('single-blog') }}">Read More
                                    <figure class="arrow mb-0"><img src="{{ asset('webflux/assets/images/blog-arrow.png') }}" alt="" class="img-fluid">
                                    </figure>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- owl carousel -->
        </div>
        <!-- container -->
    </div>
    <!-- news and articles con -->
</section>

@endsection
                    