jQuery(function($) {
    $('.home-gallery').slick({
        infinite: true,
        slidesToShow: 5,
        dots: true,
        arrows: false,
        loop:true,
        slidesToScroll: 1,
          responsive: [
          {
            breakpoint: 1024,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 3,
            }
          },
          {
            breakpoint: 600,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2
            }
          },
          {
            breakpoint: 480,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1
            }
          }
          // You can unslick at a given breakpoint now by adding:
          // settings: "unslick"
          // instead of a settings object
          ]
    });

    // if($('.entry-content table').length > 0){
    //     $('.entry-content table').each(function(i, obj) {
    //         $(this).addClass('table');
    //         $(this).after( "<div class='table-responsive table"+i+"' style='max-width: 30rem;'></div>" );
    //         $(this).appendTo(".table"+i+"");
    //         $(this).find('thead').addClass('table-dark');
    //     });
    // }
});
