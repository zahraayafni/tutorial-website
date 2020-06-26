const navSlide = () => {    
     // On scroll 
  $(window).on('scroll', function() {
  if ($(window).scrollTop()) {
    $('nav').addClass('nav-opacity');
  }
  else { 
    $('nav').removeClass('nav-opacity');
  }
});
  
}

window.onload = navSlide;