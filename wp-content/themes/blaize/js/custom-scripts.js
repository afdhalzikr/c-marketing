jQuery(document).ready(function ($) {

	/** Preloader **/
	$( window ).load( function() {
		$('.blz-loader').fadeOut();
	});

	/** Menu Toggle **/
	$('.nav-toggle').click( function () {
		$(this).parents('.menu-toggle-container').next('.mbl-main-menu-container').toggleClass('show-nav');
	} );

	$('.mbl-main-menu-container li.menu-item-has-children').click( function (e) {
		//e.preventDefault();
		$(this).toggleClass('active');
		$(this).children('.sub-menu').toggleClass('sub-show');
	} );

	/** Search Toggle **/
	$(".menu-item .fa-search").click(function (e) {
		e.preventDefault();
        $('.blz-popup-search').addClass('active');
    });

    $('.close-popup-search').on( 'click', function () {
    	$(this).parents('.blz-popup-search').removeClass('active');
    } );

    $("body").click(function(e){
        if (!$(e.target).is('.search-form *, .fa-search')) {
            $('.menu-item .search-form').removeClass('active');
        }
    });

	/** Main Slider **/
    var blz_slider = $('.blz-main-slider');
    var slider_auto_slide = blzObj.slider_auto_slide;
	blz_slider.owlCarousel({
		nav : true,
		navText: ['<i class="fas fa-arrow-left"></i>', '<i class="fas fa-arrow-right"></i>'],
		items: 1,
		dots: true,
        loop: true,
        animateIn: 'fadeIn',
        animateOut: 'fadeOut',
        mouseDrag: false,
        autoplay: jQuery.parseJSON(slider_auto_slide)
	});
    
    blz_slider.on("changed.owl.carousel", function(event){
        // selecting the current active item
        var item = event.item.index-2;
        // first removing animation for all captions
        $('.caption').removeClass('animated fadeInUpBig');
        $('.owl-item').not('.cloned').eq(item).find('.caption').addClass('animated fadeInUpBig');
    })

	/** Counter Up **/
	$('.blz-counter .counter').counterUp({
        delay: 10,
        time: 3000
    });

    /** Portfolio Masonry **/
    var grid = $('.blz-portfolio-wrap').imagesLoaded( function() {
		grid.isotope({
			itemSelector: '.portfolio-post',
			percentPosition: true,
			masonry: {
				columnWidth: '.portfolio-post'
			}
		});
	});

	// filter items on button click
	$('.blz-portfolio-filter').on( 'click', 'li', function() {
		$('.blz-portfolio-filter li').removeClass('active');
		$(this).addClass('active')
		var filterValue = $(this).attr('data-filter');
		grid.isotope({ filter: filterValue });
	});

	/** Team Slider **/
	$('.blz-team-slider').owlCarousel({
		loop:true,
	    margin:10,
	    nav:false,
	    dots:true,
	    responsive:{
	        0:{
	            items:1
	        },
	        600:{
	            items:3
	        },
	        1000:{
	            items:4
	        }
	    }
	});

	/** Video Popup **/
	$(".blz-video-popup").modalVideo({
		channel:'youtube',
		height: 400
	});

	/** Testimonial Carousel **/
		// Layout 1
		$('.blz-testimonial-slider.layout1').owlCarousel({
			loop:true,
		    nav:true,
		    navText: ['<i class="fas fa-angle-left"></i>', '<i class="fas fa-angle-right"></i>'],
		    dots:true,
		    items: 1,
		});

		// Layout 2
		$('.blz-testimonial-slider.layout2').owlCarousel({
			loop:true,
		    nav:false,
		    navText: ['<i class="fas fa-angle-left"></i>', '<i class="fas fa-angle-right"></i>'],
		    dots:true,
		    items: 2,
		    responsive:{
		        0:{	
		            items:1
		        },
		        1000:{
		            items:2
		        }
		    }
		});

	/** Partners Slider **/
	$('.blz-partners-slider').owlCarousel({
		loop:true,
		margin:15,
		items: 5,
		dots: false,
		autoplay: true,
		responsive:{
	        0:{
	            items:1
	        },
	        600:{
	            items:3
	        },
	        1000:{
	            items:5
	        }
	    }
	});

	/** Wow Animation **/
	if( blzObj.enable_wow === '1' ) {
		new WOW().init();
	}

} );