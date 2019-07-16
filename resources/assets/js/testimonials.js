

// Create carousel 
    function createCarouselTestimonial(numberOfSlides){
        jQuery('.testimonialsList').not('.slick-initialized').slick({
            dots: true,
            arrows: true,
            infinite: true,
            slidesToShow: numberOfSlides,
            slidesToScroll: 1,
            autoplay: true,
  			autoplaySpeed: 6000,
  			pauseOnHover: true
        });
	}

// Calculate number of slides to show
	function calculateNumberOfSlidesToShowTestimonial(){
		var carouselWidth = jQuery(".testimonialsList").width();
		var numberOfSlides = 0;
      	switch (true) {
		    case (carouselWidth < 767):
		        numberOfSlides = 1;
		        break;
		    case (carouselWidth < 991):
		        numberOfSlides = 2;
		        break;
		    case (carouselWidth < 1199):
		        numberOfSlides = 3;
		        break;
		    case (carouselWidth > 1200):
		        numberOfSlides = 3;
		        break;
		}

		return numberOfSlides;
	}

// Reload Carousel on browser resize (to make it responsible)

    function reloadCarouselTestimonial () {
      	jQuery('.testimonialsList').slick('unslick');
      	numberOfSlides = calculateNumberOfSlidesToShowTestimonial();
	    createCarouselTestimonial(numberOfSlides);
    }

// Call updateMaxHeight when browser resize event fires
    jQuery(window).on("resize", reloadCarouselTestimonial);



jQuery(document).ready(function () {
	// Start carousel
	    if (jQuery(".testimonialsList").length) {
	        setTimeout(function () {
	        	numberOfSlides = calculateNumberOfSlidesToShowTestimonial();
	            createCarouselTestimonial(numberOfSlides);
	        }, 300);
	    }


});
