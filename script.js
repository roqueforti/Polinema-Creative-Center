$(document).ready(function() {
    $('a[href^="#"]').on('click', function(event) {
      var target = $(this.getAttribute('href'));
      if( target.length ) {
        event.preventDefault();
        $('html, body').stop().animate({
          scrollTop: target.offset().top
        }, 1000);
      }
    });
  
    $('#reservationForm').on('submit', function(event) {
      event.preventDefault();
      setTimeout(function() {
        $('#reservationForm').trigger('reset');
        alert('Thank you for your reservation!');
      }, 1000);
    });
  });
  