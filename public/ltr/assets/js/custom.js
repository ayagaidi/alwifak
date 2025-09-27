var btn = $('#button');

$(window).on('scroll', function () {
  if ($(window).scrollTop() > 300) {
    btn.addClass('show');
  } else {
    btn.removeClass('show');
  }
}).on('click', '#button', function (e) {
  e.preventDefault();
  $('html, body').animate({
    scrollTop: 0
  }, '300');
});


$(window).on('load', function () {
  // Preloader
  $('.loader').fadeOut();
  $('.loader-mask').delay(350).fadeOut('slow');
});

$(document).ready(function () {
  var owl = $('.recent-projects-con .owl-carousel');

  function initializeCarousel(marginValue) {
    owl.owlCarousel('destroy'); // Destroy existing instance if any
    owl.owlCarousel({
      margin: marginValue,
      nav: false,
      loop: true,
      dots: true,
      autoplay: true,
      autoplayTimeout: 4500,
      responsive: {
        0: {
          items: 1
        },
        576: {
          items: 2
        },
        768: {
          items: 3
        },
        992: {
          items: 4
        },
        1200: {
          items: 5
        }
      }
    });
  }

  function adjustMargin() {
    if (window.innerWidth <= 1440) {
      initializeCarousel(20); // Set margin to 20 for max-width 1440px
    } else {
      initializeCarousel(30); // Default margin for larger screens
    }
  }

  // Initial call to set the correct margin
  adjustMargin();

  // Adjust carousel on window resize
  $(window).on('resize', function () {
    adjustMargin();
  });
});
$(document).ready(function () {
  var owl = $('.recent-projects-con.latest-case-studies-con .owl-carousel');

  function initializeCarousel(marginValue) {
    owl.owlCarousel('destroy'); // Destroy existing instance if any
    owl.owlCarousel({
      margin: marginValue,
      nav: false,
      loop: true,
      dots: true,
      autoplay: true,
      autoplayTimeout: 4500,
      responsive: {
        0: {
          items: 1
        },
        576: {
          items: 2
        },
        768: {
          items: 3
        },
        992: {
          items: 3
        },
        1200: {
          items: 3
        }
      }
    });
  }

  function adjustMargin() {
    if (window.innerWidth <= 1440) {
      initializeCarousel(20); // Set margin to 20 for max-width 1440px
    } else {
      initializeCarousel(30); // Default margin for larger screens
    }
  }

  // Initial call to set the correct margin
  adjustMargin();

  // Adjust carousel on window resize
  $(window).on('resize', function () {
    adjustMargin();
  });
});


$(document).ready(function () {
  var owl = $('.our-expertise-con .owl-carousel');
  owl.owlCarousel({
    margin: 30,
    nav: true,
    loop: true,
    dots: false,
    // navText: [
    //   "<i class='fa-solid fa-angle-left'></i>",
    //   "<i class='fa-solid fa-angle-right'></i>"
    // ],
    autoplay: true,
    autoplayTimeout: 6000,
    responsive: {
      0: {
        items: 1
      },
      576: {
        items: 2
      },
      768: {
        items: 3
      },
      992: {
        items: 4
      }
    }
  })
})
$(document).ready(function () {
  var owl = $('.testimonials-con .owl-carousel');
  owl.owlCarousel({
    margin: 30,
    nav: false,
    loop: true,
    dots: true,
    autoplay: true,
    autoplayTimeout: 4500,
    responsive: {
      0: {
        items: 1
      },
      576: {
        items: 1
      },
      768: {
        items: 2
      },
      992: {
        items: 2
      }
    }
  })
})

// news and articles carousel js
$(document).ready(function () {
  var owl = $('.news-and-articles-con .owl-carousel');

  function initializeCarousel(marginValue) {
    owl.owlCarousel('destroy'); // Destroy existing instance if any
    owl.owlCarousel({
      margin: marginValue,
      nav: false,
      loop: true,
      dots: true,
      autoplay: true,
      autoplayTimeout: 4500,
      responsive: {
        0: {
          items: 1
        },
        576: {
          items: 2
        },
        768: {
          items: 3
        },
        992: {
          items: 3
        }
      }
    });
  }

  function adjustMargin() {
    if (window.innerWidth <= 991) {
      initializeCarousel(18); // Set margin to 18 for max-width 1440px
    } else {
      initializeCarousel(30); // Default margin for larger screens
    }
  }

  // Initial call to set the correct margin
  adjustMargin();

  // Adjust carousel on window resize
  $(window).on('resize', function () {
    adjustMargin();
  });
});

// 
$(document).ready(function () {
  var owl = $('.project-testimonial-con .owl-carousel');
  owl.owlCarousel({
    margin: 30,
    nav: true,
    loop: true,
    dots: false,
    navText: [
      "<img src='assets/images/left-arrow-image.png' alt='Left'>", // Left arrow image
      "<img src='assets/images/right-arrow-image.png' alt='Right'>" // Right arrow image
    ],
    autoplay: true,
    autoplayTimeout: 4500,
    responsive: {
      0: {
        items: 1
      },
      576: {
        items: 1
      },
      992: {
        items: 1
      }
    }
  });
});
$(document).ready(function () {
  var owl = $('.expertise-con .owl-carousel');
  owl.owlCarousel({
    margin: 25,
    nav: false,
    loop: true,
    dots: true,
    autoplay: true,
    autoplayTimeout: 4500,
    responsive: {
      0: {
        items: 1
      },
      576: {
        items: 1
      },
      768: {
        items: 2
      },
      992: {
        items: 2
      },
      1200: {
        items: 2
      },
      1440: {
        items: 3
      }
    }
  })
})

// wow js
new WOW().init();

// comingsoon page countdown js
(function () {
  if (document.getElementById("days") !== null) {
    const second = 1000,
      minute = second * 60,
      hour = minute * 60,
      day = hour * 24;

    let today = new Date(),
      dd = String(today.getDate()).padStart(2, "0"),
      mm = String(today.getMonth() + 1).padStart(2, "0"),
      yyyy = today.getFullYear(),
      nextYear = '2025',
      dayMonth = "02/30/",
      birthday = dayMonth + yyyy;

    today = mm + "/" + dd + "/" + yyyy;
    if (today > birthday) {
      birthday = dayMonth + nextYear;
    }
    //end

    const countDown = new Date(birthday).getTime(),
      x = setInterval(function () {
        const now = new Date().getTime(),
          distance = countDown - now;

        let days = Math.floor(distance / (day));
        let hours = Math.floor((distance % (day)) / (hour));
        let minutes = Math.floor((distance % (hour)) / (minute));
        let seconds = Math.floor((distance % (minute)) / second);

        document.getElementById("days").innerText = days,
          document.getElementById("hours").innerText = hours,
          document.getElementById("minutes").innerText = minutes,
          document.getElementById("seconds").innerText = seconds;

        //do something later when date is reached
        if (distance < 0) {
          clearInterval(x);
          var items = document.querySelectorAll(".compaign_countdown");
          for (var i = 0; i <= items.length; i++) {
            if (typeof items[i] !== 'undefined') {
              items[i].style.display = "none";
            }
          }
        }
        //seconds
      }, 0)
  }
}());
// Get the button
var backButton = document.getElementById("back-to-top-btn");

if ($('#back-to-top-btn').length) {

  // When the user scrolls down 20px from the top of the document, show the button
  window.onscroll = function () {
    scrollFunction();
  };

  function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
      backButton.style.display = "block";
    } else {
      backButton.style.display = "none";
    }
  }
  // When the user clicks on the button, scroll to the top of the document
  backButton.addEventListener("click", function () {
    document.body.scrollTop = 0; // For Safari
    document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
  });
}