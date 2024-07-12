  $('#first').slick({
  infinite: false,
  rows: 2,
  slidesToShow: 4,
  slidesToScroll: 1,
  speed: 1000,
  appendArrows: '#toggle-first',
  responsive: [
    {
      breakpoint: 1245,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1,
      }
    },
    {
      breakpoint: 940,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 650,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
  ]
});

  $('#second').slick({
  infinite: false,
  rows: 1,
  slidesToShow: 4,
  slidesToScroll: 1,
  speed: 1000,
  appendArrows: '#toggle-second',
    responsive: [
    {
      breakpoint: 1245,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1,
        infinite: false,
      }
    },
    {
      breakpoint: 940,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 650,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
  ]
});

  $('#slider').slick({
    arrows: false,
    asNavFor: '#slider_2',
  });

  $('#slider_2').slick(
      {
          asNavFor: '#slider',
          infinite: true,
          centerMode: true,
          centerPadding: '35px',
          slidesToShow: 3,
          slidesToScroll: 1,
          focusOnSelect: true,
              responsive: [
    {
      breakpoint: 930,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1,
        infinite: true,
      }
    },
    {
      breakpoint: 940,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1,
        infinite: true,
      }
    },
    {
      breakpoint: 650,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1,
        infinite: true,
      }
    }
  ]
      }
  );

  $('#catalog').slick({
    infinite: false,
    slidesToShow: 4,
    slidesToScroll: 2,
    speed: 1500,
    appendArrows: '#toggle-first',
      responsive: [
    {
      breakpoint: 1245,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1,
        infinite: false,
      }
    },
    {
      breakpoint: 940,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 650,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
  ]
  });


    $('.slider').slick({
      arrows: false,
      asNavFor: '.slider-nav',
    });

    $('.slider-nav').slick({
      asNavFor: '.slider',
      focusOnSelect: true,
      slidesToShow: 3,
      infinite: true,
      centerMode: true,
      prevArrow: '<button id="prev"></button>',
      nextArrow: '<button id="next"></button>',
    });
