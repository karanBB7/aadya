document.addEventListener('DOMContentLoaded', function() {
  const stars = document.querySelectorAll('.star');
  const ratingValue = document.getElementById('ratingValue');

  stars.forEach(function(star) {
    star.addEventListener('click', function() {
      const value = parseInt(star.getAttribute('data-value'));
      ratingValue.innerText = 'You rated ' + value + ' stars.';
      // You can implement further logic here like sending the rating to a server
    });
  });
});

// Owl-carousel for doctor Videos
$(document).ready(function(){
  $('.docslider').owlCarousel({
    center: true,
    items:2,
    loop:true,
    margin:15,
    responsive:{
        600:{
          nav:true,
            items:3
        },
        0:{
          items:2,
          // nav:true
      }
    }
});
  $('.dateslider').owlCarousel({
    center: true,
    items:2,
    loop:true,
    margin:15,
    responsive:{
        600:{
          nav:true,
            items:7
        },
        0:{
          items:2,
          // nav:true
      }
    }
});
});