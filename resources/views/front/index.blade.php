@extends('front.app')

@section('title', 'Home')

@section('content')
<!-- BANNER SECTION -->
<section class="float-left w-100 position-relative banner-con2 main-box">
  
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="banner-content">
                    <span class="d-inline-block aqua-text font-weight-normal inter-font"><i
                        class="fa-solid fa-circle mr-1"></i> {{ trans('front.banner_best_agency') }} <i class="fa-solid fa-circle ml-1"></i></span>
                    <h1>{{ trans('front.banner_empowering') }}
                    </h1>
                    <p class="text-white">{{ trans('front.banner_description') }}</p>
                    <div class="primary-button d-inline-block">
                        <a href="{{ route('contact') }}" class="d-inline-block">{{ trans('front.banner_button') }} <i
                            class="fa-solid fa-arrow-right ml-2"></i></a>
                    </div>
                    <ul class="list-unstyled position-relative banner-icons">
                        <li class="d-inline-block"><a href="https://www.facebook.com/login/" class="ml-0 d-block"><i
                              class="fa-brands fa-facebook-f ml-0"></i></a></li>
                        <li class="d-inline-block"><a href="https://twitter.com/i/flow/login" class="d-block"><i
                              class="fa-brands fa-x-twitter"></i></a></li>
                        <li class="d-inline-block"><a href="https://www.instagram.com/" class="mr-0 d-block"><i
                              class="fa-brands fa-youtube"></i></a></li>
                        <li class="d-inline-block"><a href="https://www.linkedin.com/" class="mr-0 d-block"><i
                              class="fa-brands fa-linkedin-in mr-0"></i></a></li>
                    </ul>
                    <!-- banner content -->
                </div>
                <!-- col -->
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="banner-img-con position-relative">
                    <figure><img src="{{ asset('webflux/assets/images/home02/home2-img.png') }}" alt="image" class="position-relative"></figure>

                    <!-- banner img con -->
                </div>
                <!-- col -->
            </div>
            <!-- row -->
        </div>
        <!-- container -->
    </div>
    <!-- sub banner con -->
</section>

<!-- GROW YOUR BUSINESS SECTION -->
<section
  class="float-left w-100 position-relative grow-your-business-con padding-top padding-bottom main-box background-f4f5ff">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 col-md-6">
        <div class="grow-img-con position-relative">
          <figure><img src="{{ asset('webflux/assets/images/grow-busines-img.png') }}" alt="image" class="img-fluid busines-img">
          </figure>
  
          <!-- grow business img con -->
        </div>
        <!-- col -->
      </div>
      <div class="col-lg-6 col-md-6">
        <div class="grow-business-content-con">
          <figure><img src="{{ asset('webflux/assets/images/grow-logo.svg') }}" alt="icon" class="img-fluid grow-logo"></figure>
          <div class="heading-title-con mb-0">
            <span class="d-block special-text blue-text inter-font font-weight-light">{{ trans('front.grow_your_business') }}</span>
            <h2 class="black-family-text">{{ trans('front.generate_traffic') }}</h2>
            <p class="">{{ trans('front.grow_description') }}</p>
            <ul class="list-unstyled p-0">
              <li class="position-relative black-family-text outfit-font font-weight-bold"><i
                  class="fa-solid fa-circle-check"></i>{{ trans('front.advertising_marketing') }}</li>
              <li class="position-relative black-family-text outfit-font font-weight-bold"><i
                  class="fa-solid fa-circle-check"></i>{{ trans('front.web_development') }}
              </li>
              <li class="position-relative black-family-text outfit-font font-weight-bold"><i
                  class="fa-solid fa-circle-check"></i>{{ trans('front.mobile_app_development') }}</li>
              <li class="position-relative black-family-text outfit-font font-weight-bold mb-0"><i
                  class="fa-solid fa-circle-check"></i>{{ trans('front.search_engine_optimization') }}</li>
              <!-- listing -->
            </ul>
            <div class="secondary-button d-inline-block">
              <a href="{{ route('contact') }}" class="d-inline-block">{{ trans('front.get_started') }} <i
                  class="fa-solid fa-arrow-right ml-2"></i></a>
            </div>
            <!-- heading title con -->
          </div>
          <!-- grow busines content con -->
        </div>
        <!-- col -->
      </div>
      <!-- row -->
    </div>
    <!-- container -->
  </div>
</section>

<!-- SERVICES SECTION -->
<section class="float-left w-100 position-relative services-con padding-top padding-bottom main-box" >
  <figure><img src="{{ asset('webflux/assets/images/vector3.png') }}" alt="icon" class="img-fluid position-absolute vector3"></figure>
  <figure><img src="{{ asset('webflux/assets/images/vector4.png') }}" alt="icon" class="img-fluid position-absolute vector4"></figure>
  <div class="container">
    <div class="heading-title-con text-center">
      <span class="d-block special-text blue-text inter-font font-weight-light">{{ trans('front.webflux_services') }}</span>
      <h2 class="black-family-text">{{ trans('front.transforming_ideas') }}</h2>
      <p class="mb-0">{{ trans('front.services_description') }}</p>
      <!-- heading title con -->
    </div>
    <div class="row">
      <div class="col-lg-3 col-md-6">
        <div class="services-box">
          <figure><img src="{{ asset('webflux/assets/images/services-icon1.png') }}" alt="icon" class="img-fluid"></figure>
          <h4 class="">{{ trans('front.digital_marketing') }}</h4>
          <p class="">{{ trans('front.service_description') }}</p>
          <a href="{{ route('service') }}"><i class="fa-solid fa-arrow-right"></i></a>
          <!-- services box -->
        </div>
        <!-- col -->
      </div>
      <div class="col-lg-3 col-md-6">
        <div class="services-box">
          <figure><img src="{{ asset('webflux/assets/images/services-icon2.png') }}" alt="icon" class="img-fluid"></figure>
          <h4 class="">{{ trans('front.product_development') }}</h4>
          <p class="">{{ trans('front.service_description') }}</p>
          <a href="{{ route('service') }}"><i class="fa-solid fa-arrow-right"></i></a>
          <!-- services box -->
        </div>
        <!-- col -->
      </div>
      <div class="col-lg-3 col-md-6">
        <div class="services-box">
          <figure><img src="{{ asset('webflux/assets/images/services-icon3.png') }}" alt="icon" class="img-fluid"></figure>
          <h4 class="">{{ trans('front.ui_ux_designing') }}</h4>
          <p class="">{{ trans('front.service_description') }}</p>
          <a href="{{ route('service') }}"><i class="fa-solid fa-arrow-right"></i></a>
          <!-- services box -->
        </div>
        <!-- col -->
      </div>
      <div class="col-lg-3 col-md-6">
        <div class="services-box">
          <figure><img src="{{ asset('webflux/assets/images/services-icon4.png') }}" alt="icon" class="img-fluid"></figure>
          <h4 class="">{{ trans('front.data_analysis') }}</h4>
          <p class="">{{ trans('front.service_description') }}</p>
          <a href="{{ route('service') }}"><i class="fa-solid fa-arrow-right"></i></a>
          <!-- services box -->
        </div>
        <!-- col -->
      </div>
      <!-- row -->
    </div>
    <div class="float-left-w-100 text-center strt-project-con">
      <div class="secondary-button d-inline-block">
        <a href="{{ route('contact') }}" class="d-inline-block">{{ trans('front.start_your_project') }} <i
            class="fa-solid fa-arrow-right ml-2"></i></a>
      </div>
      <!-- start projct con -->
    </div>
    <!-- container -->
  </div>
  <!-- services con -->
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
            <span class="d-block special-text blue-text inter-font font-weight-normal">{{ trans('front.about_us') }}</span>
            <h2 class="black-family-text position-relative">{{ trans('front.passionate_experts') }}</h2>
            <!-- heading title con -->
          </div>
          <div class="row fun-inner-row">
            <div class="col-lg-6 col-md-6 col-sm-6">
              <div class="fact-box">
                <figure><img src="{{ asset('webflux/assets/images/fun-fact-icon1.png') }}" alt="icon" class="img-fluid"></figure>
                <span class="d-inline-block black-family-text counter font-weight-800 outfit-font">2975 </span> <sup
                  class="d-inline-block blue-text font-weight-800 outfit-font">+</sup>
                <span class="span-text d-block inter-font">{{ trans('front.business_ideas') }}</span>
                <!-- fact box -->
              </div>
              <!-- col -->
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
              <div class="fact-box">
                <figure><img src="{{ asset('webflux/assets/images/fun-fact-icon2.png') }}" alt="icon" class="img-fluid"></figure>
                <span class="d-inline-block black-family-text counter font-weight-800 outfit-font">3345 </span> <sup
                  class="d-inline-block blue-text font-weight-800 outfit-font">+</sup>
                <span class="span-text d-block inter-font">{{ trans('front.happy_customers') }}</span>
                <!-- fact box -->
              </div>
              <!-- col -->
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
              <div class="fact-box">
                <figure><img src="{{ asset('webflux/assets/images/fun-fact-icon3.png') }}" alt="icon" class="img-fluid"></figure>
                <span class="d-inline-block black-family-text counter font-weight-800 outfit-font">1050 </span> <sup
                  class="d-inline-block blue-text font-weight-800 outfit-font">+</sup>
                <span class="span-text d-block inter-font">{{ trans('front.media_posts') }}</span>
                <!-- fact box -->
              </div>
              <!-- col -->
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
              <div class="fact-box">
                <figure><img src="{{ asset('webflux/assets/images/fun-fact-icon4.png') }}" alt="icon" class="img-fluid"></figure>
                <span class="d-inline-block black-family-text counter font-weight-800 outfit-font">7456 </span> <sup
                  class="d-inline-block blue-text font-weight-800 outfit-font">+</sup>
                <span class="span-text d-block inter-font">{{ trans('front.finished_projects') }}</span>
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

<!-- SERVICES STEPS SECTION -->
<section class="float-left w-100 services-step-con position-relative padding-top padding-bottom main-box text-center">
  <figure><img src="{{ asset('webflux/assets/images/vector5.png') }}" alt="icon" class="img-fluid position-absolute vector5"></figure>
  <div class="container">
    <div class="heading-title-con text-center">
      <span class="d-block special-text text-white inter-font font-weight-light">{{ trans('front.proven_process') }}</span>
      <h2 class="text-white mb-0">{{ trans('front.focus_marketing_innovation') }}</h2>
      <!-- heading title con -->
    </div>
    <div class="row">
      <div class="col-lg-3 col-md-6">
        <div class="step-box">
          <span class="d-block step-count text-white inter-font">01</span>
          <figure><img src="{{ asset('webflux/assets/images/step-icon1.png') }}" alt="icon" class="img-fluid"></figure>
          <h4>{{ trans('front.concept') }}</h4>
          <p class="mb-0">{{ trans('front.step_description') }}</p>
          <!-- step box -->
        </div>
        <!-- col -->
      </div>
      <div class="col-lg-3 col-md-6">
        <div class="step-box">
          <span class="d-block step-count text-white inter-font">02</span>
          <figure><img src="{{ asset('webflux/assets/images/step-icon2.png') }}" alt="icon" class="img-fluid"></figure>
          <h4>{{ trans('front.budget') }}</h4>
          <p class="mb-0">{{ trans('front.step_description') }}</p>
          <!-- step box -->
        </div>
        <!-- col -->
      </div>
      <div class="col-lg-3 col-md-6">
        <div class="step-box">
          <span class="d-block step-count text-white inter-font">03</span>
          <figure><img src="{{ asset('webflux/assets/images/step-icon3.png') }}" alt="icon" class="img-fluid"></figure>
          <h4>{{ trans('front.development') }}</h4>
          <p class="mb-0">{{ trans('front.step_description') }}</p>
          <!-- step box -->
        </div>
        <!-- col -->
      </div>
      <div class="col-lg-3 col-md-6">
        <div class="step-box">
          <span class="d-block step-count text-white inter-font">04</span>
          <figure><img src="{{ asset('webflux/assets/images/step-icon4.png') }}" alt="icon" class="img-fluid"></figure>
          <h4>{{ trans('front.result') }}</h4>
          <p class="mb-0">{{ trans('front.step_description') }}</p>
          <!-- step box -->
        </div>
        <!-- col -->
      </div>
      <!-- row -->
    </div>
    <!-- container -->
  </div>
  <!-- services step con -->
</section>



<!-- PROJECT TESTIMONIALS SECTION -->
<section class="float-left w-100 position-relative padding-top padding-bottom main-box project-testimonial-con">
  <figure><img src="{{ asset('webflux/assets/images/vector1.png') }}" alt="vector" class="img-fluid position-absolute vector1"></figure>
  <figure><img src="{{ asset('webflux/assets/images/vector2.png') }}" alt="vector" class="img-fluid position-absolute vector2"></figure>
  <div class="container">
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
                <span class="d-block special-text blue-text inter-font font-weight-light">{{ trans('front.testimonials') }}</span>
                <h2 class="black-family-text">{{ trans('front.customers_say') }}</h2>
                <p class="">{{ trans('front.testimonial_description') }}</p>
                <!-- heading title con -->
              </div>
              <div class="review-content d-flex align-items-center">
                <figure class="testimonial-personimage mb-0">
                  <img src="{{ asset('webflux/assets/images/project-quote-icon.png') }}" alt="image" class="">
                </figure>
                <div class="detail">
                  <span class="name">{{ trans('front.kevin_james') }}</span>
                  <span class="position">{{ trans('front.happy_client') }}</span>
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
                <span class="d-block special-text blue-text inter-font font-weight-light">{{ trans('front.testimonials') }}</span>
                <h2 class="black-family-text">{{ trans('front.customers_say') }}</h2>
                <p class="">{{ trans('front.testimonial_description') }}</p>
                <!-- heading title con -->
              </div>
              <div class="review-content d-flex align-items-center">
                <figure class="testimonial-personimage mb-0">
                  <img src="{{ asset('webflux/assets/images/project-quote-icon.png') }}" alt="image" class="">
                </figure>
                <div class="detail">
                  <span class="name">{{ trans('front.kevin_james') }}</span>
                  <span class="position">{{ trans('front.happy_client') }}</span>
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
  <div class="container">
    <div class="heading-title-con text-center">
      <span class="d-block special-text blue-text inter-font font-weight-light">{{ trans('front.news_articles') }}</span>
      <h2 class="black-family-text">{{ trans('front.latest_blog_posts') }}</h2>
      <p class="mb-0">{{ trans('front.news_description') }}</p>
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
                <span class="text-white">{{ trans('front.march') }}</span>
              </div>
            </div>
          </div>
          <div class="lower_portion_wrapper">
            <div class="lower_portion">
               <a href="{{ route('single-blog') }}"><h4>{{ trans('front.useful_tips') }}</h4></a>
              <p class="text-size-18">{{ trans('front.blog_description') }}</p>
              <a class="read_more text-decoration-none" href="{{ route('single-blog') }}">{{ trans('front.read_more') }}
                <figure class="arrow mb-0"><img src="{{ asset('webflux/assets/images/blog-arrow.png') }}" alt="" class="img-fluid">
                </figure>
              </a>
            </div>
          </div>
        </div>
      </div>
      <div class="item">
        <div class="blog_boxcontent">
          <div class="upper_portion">
            <figure class="mb-0"><img src="{{ asset('webflux/assets/images/news-img2.jpg') }}" class="article_img" alt=""></figure>
            <div class="image_content">
              <div class="content">
                <h3 class="text-white counter">26</h3>
                <span class="text-white">{{ trans('front.april') }}</span>
              </div>
            </div>
          </div>
          <div class="lower_portion_wrapper">
            <div class="lower_portion">
              <a href="{{ route('single-blog') }}"><h4>{{ trans('front.service_future') }}</h4></a>
              <p class="text-size-18">{{ trans('front.blog_description') }}</p>
              <a class="read_more text-decoration-none" href="{{ route('single-blog') }}">{{ trans('front.read_more') }}
                <figure class="arrow mb-0"><img src="{{ asset('webflux/assets/images/blog-arrow.png') }}" alt="" class="img-fluid">
                </figure>
              </a>
            </div>
          </div>
        </div>
      </div>
      <div class="item">
        <div class="blog_boxcontent mb-0">
          <div class="upper_portion">
            <figure class="mb-0"><img src="{{ asset('webflux/assets/images/news-img3.jpg') }}" class="article_img" alt=""></figure>
            <div class="image_content">
              <div class="content">
                <h3 class="text-white counter">09</h3>
                <span class="text-white">{{ trans('front.june') }}</span>
              </div>
            </div>
          </div>
          <div class="lower_portion_wrapper">
            <div class="lower_portion">
              <a href="{{ route('single-blog') }}"><h4>{{ trans('front.ease_pain') }}</h4></a>
              <p class="text-size-18">{{ trans('front.blog_description') }}</p>
              <a class="read_more text-decoration-none" href="{{ route('single-blog') }}">{{ trans('front.read_more') }}
                <figure class="arrow mb-0"><img src="{{ asset('webflux/assets/images/blog-arrow.png') }}" alt="" class="img-fluid">
                </figure>
              </a>
            </div>
          </div>
        </div>
      </div>
      <!-- Additional items for carousel as in original -->
      <div class="item">
        <div class="blog_boxcontent">
          <div class="upper_portion">
            <figure class="mb-0"><img src="{{ asset('webflux/assets/images/news-img1.jpg') }}" class="article_img" alt=""></figure>
            <div class="image_content">
              <div class="content">
                <h3 class="text-white counter">18</h3>
                <span class="text-white">{{ trans('front.march') }}</span>
              </div>
            </div>
          </div>
          <div class="lower_portion_wrapper">
            <div class="lower_portion">
               <a href="{{ route('single-blog') }}"><h4>{{ trans('front.useful_tips') }}</h4></a>
              <p class="text-size-18">{{ trans('front.blog_description') }}</p>
              <a class="read_more text-decoration-none" href="{{ route('single-blog') }}">{{ trans('front.read_more') }}
                <figure class="arrow mb-0"><img src="{{ asset('webflux/assets/images/blog-arrow.png') }}" alt="" class="img-fluid">
                </figure>
              </a>
            </div>
          </div>
        </div>
      </div>
      <div class="item">
        <div class="blog_boxcontent">
          <div class="upper_portion">
            <figure class="mb-0"><img src="{{ asset('webflux/assets/images/news-img2.jpg') }}" class="article_img" alt=""></figure>
            <div class="image_content">
              <div class="content">
                <h3 class="text-white counter">26</h3>
                <span class="text-white">{{ trans('front.april') }}</span>
              </div>
            </div>
          </div>
          <div class="lower_portion_wrapper">
            <div class="lower_portion">
              <a href="{{ route('single-blog') }}"><h4>{{ trans('front.service_future') }}</h4></a>
              <p class="text-size-18">{{ trans('front.blog_description') }}</p>
              <a class="read_more text-decoration-none" href="{{ route('single-blog') }}">{{ trans('front.read_more') }}
                <figure class="arrow mb-0"><img src="{{ asset('webflux/assets/images/blog-arrow.png') }}" alt="" class="img-fluid">
                </figure>
              </a>
            </div>
          </div>
        </div>
      </div>
      <div class="item">
        <div class="blog_boxcontent mb-0">
          <div class="upper_portion">
            <figure class="mb-0"><img src="{{ asset('webflux/assets/images/news-img3.jpg') }}" class="article_img" alt=""></figure>
            <div class="image_content">
              <div class="content">
                <h3 class="text-white counter">09</h3>
                <span class="text-white">{{ trans('front.june') }}</span>
              </div>
            </div>
          </div>
          <div class="lower_portion_wrapper">
            <div class="lower_portion">
              <a href="{{ route('single-blog') }}"><h4>{{ trans('front.ease_pain') }}</h4></a>
              <p class="text-size-18">{{ trans('front.blog_description') }}</p>
              <a class="read_more text-decoration-none" href="{{ route('single-blog') }}">{{ trans('front.read_more') }}
                <figure class="arrow mb-0"><img src="{{ asset('webflux/assets/images/blog-arrow.png') }}" alt="" class="img-fluid">
                </figure>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- container -->
  </div>
  <!-- news and articles con -->
</section>
@endsection
