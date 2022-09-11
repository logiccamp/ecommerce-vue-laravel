// $('.recommendedCarousel').owlCarousel({
//     loop:true,
//     margin:10,
//     autoplay:true,
//     responsiveClass:true,
//     responsive:{
//         0:{
//             items:5,
//             nav:true
//         },
//         600:{
//             items:5,
//             nav:false
//         },
//         1000:{
//             items:5,
//             nav:true,
//             loop:false
//         }
//     }
// })

$('.recommendedCarousel').slick({
    slidesToShow: 3,
    slidesToScroll: 3,
    dots: true,
    arrows: true,
    infinite: false,
    speed: 300,
    adaptiveHeight: true,
    responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 3,
            infinite: true,
            dots: true
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
    ]
  });