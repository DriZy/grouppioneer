jQuery(function($){
	"use strict";

var CAPITAL = window.CAPITAL || {};

CAPITAL.megaMenu = function() {
        jQuery('.megamenu-sub-title').closest('ul.sub-menu').wrapInner('<div class="row" />').wrapInner('<div class ="megamenu-container container" />').wrapInner('<li />');
        jQuery('.megamenu-container').closest('li.menu-item-has-children').addClass('megamenu');
        var $class = '';
		jQuery(".megamenu-container").each(function(index, elem) {
    		var numImages = $(this).find('.row').children('li').length;
			switch (numImages)
			{
				case 1:
					$class = 12;
					break;
				case 2:
					$class = 6;
					break;
				case 3:
					$class = 4;
					break;
				case 4:
					$class = 3;
					break;
				default:
					$class = 2;
			}
		$(this).find('.row').find('.col-md-3').each(function() {
            jQuery(this).removeClass('col-md-3').addClass('col-md-' + $class);
        });
});
};

/* ==================================================
	Scroll Functions
================================================== */
	CAPITAL.scrollFunctions = function(){
		var didScroll = false;
	
		var $arrow = $('#back-to-top');
		var $sticky_header_wrapper = $('.theme-sticky-header');
	
		$arrow.on('click',function(e) {
			$('body,html').animate({ scrollTop: "0" }, 750, 'easeOutExpo' );
			e.preventDefault();
		});
	
		$(window).scroll(function() {
			didScroll = true;
		});
	
		setInterval(function() {
			if( didScroll ) {
				didScroll = false;
	
				if( $(window).scrollTop() > 200 ) {
					$arrow.css("right",20);
				} else {
					$arrow.css("right","-50px");
				}
				
				
					if( $(window).scrollTop() > 200 ) {
						$sticky_header_wrapper.css("margin-top",'0');
					} else {
						$sticky_header_wrapper.css("margin-top","-999px");
					}
				
			}
		}, 250);
	};
/* ==================================================
   Accordion
================================================== */
	CAPITAL.accordion = function(){
		var accordion_trigger = $('.accordion-heading.accordionize');
		
		accordion_trigger.delegate('.accordion-toggle','click', function(event){
			if($(this).hasClass('active')){
				$(this).removeClass('active');
				$(this).addClass('inactive');
			}
			else{
				accordion_trigger.find('.active').addClass('inactive');          
				accordion_trigger.find('.active').removeClass('active');   
				$(this).removeClass('inactive');
				$(this).addClass('active');
			}
			event.preventDefault();
		});
	};
/* ==================================================
   Toggle
================================================== */
	CAPITAL.toggle = function(){
		var accordion_trigger_toggle = $('.accordion-heading.togglize');
		
		accordion_trigger_toggle.delegate('.accordion-toggle','click', function(event){
			if($(this).hasClass('active')){
				$(this).removeClass('active');
				$(this).addClass('inactive');
			}
			else{
				$(this).removeClass('inactive');
				$(this).addClass('active');
			}
			event.preventDefault();
		});
	};
/* ==================================================
   Tooltip
================================================== */
	CAPITAL.toolTip = function(){ 
		$('a[data-toggle=tooltip]').tooltip(); 
		$('a[data-toggle=tooltip]').tooltip();
		$('a[data-toggle=popover]').popover({html:true}).on("click", function(e) { 
       		e.preventDefault(); 
       		$(this).focus(); 
		});
	};
/* ==================================================
   Hero Flex Slider
================================================== */
	CAPITAL.heroflex = function() {
		$('.heroflex').each(function(){
				var carouselInstance = $(this); 
				var carouselAutoplay = carouselInstance.attr("data-autoplay") === 'yes' ? true : false;
				var carouselPagination = carouselInstance.attr("data-pagination") === 'yes' ? true : false;
				var carouselArrows = carouselInstance.attr("data-arrows") === 'yes' ? true : false;
				var carouselDirection = carouselInstance.attr("data-direction") ? carouselInstance.attr("data-direction") : "horizontal";
				var carouselStyle = carouselInstance.attr("data-style") ? carouselInstance.attr("data-style") : "fade";
				var carouselSpeed = carouselInstance.attr("data-speed") ? carouselInstance.attr("data-speed") : "5000";
				var carouselPause = carouselInstance.attr("data-pause") === 'yes' ? true : false;
				
				carouselInstance.flexslider({
					animation: carouselStyle,
					easing: "swing",
					direction: carouselDirection,
					slideshow: carouselAutoplay,
					slideshowSpeed: carouselSpeed,
					animationSpeed: 600,
					initDelay: 0,
					randomize: false,
					pauseOnHover: carouselPause,
					controlNav: carouselPagination,
					directionNav: carouselArrows,
					prevText: "",
					nextText: ""
				});
		});
	};
/* ==================================================
   Flex Slider
================================================== */
	CAPITAL.galleryflex = function() {
		$('.galleryflex').each(function(){
				var carouselInstance = $(this); 
				var carouselAutoplay = carouselInstance.attr("data-autoplay") === 'yes' ? true : false;
				var carouselPagination = carouselInstance.attr("data-pagination") === 'yes' ? true : false;
				var carouselArrows = carouselInstance.attr("data-arrows") === 'yes' ? true : false;
				var carouselDirection = carouselInstance.attr("data-direction") ? carouselInstance.attr("data-direction") : "horizontal";
				var carouselStyle = carouselInstance.attr("data-style") ? carouselInstance.attr("data-style") : "fade";
				var carouselSpeed = carouselInstance.attr("data-speed") ? carouselInstance.attr("data-speed") : "5000";
				var carouselPause = carouselInstance.attr("data-pause") === 'yes' ? true : false;
				
				carouselInstance.flexslider({
					animation: carouselStyle,
					easing: "swing",
					direction: carouselDirection,
					slideshow: carouselAutoplay,
					slideshowSpeed: carouselSpeed,
					animationSpeed: 600,
					initDelay: 0,
					animationLoop: false,
					randomize: false,
					pauseOnHover: carouselPause,
					controlNav: carouselPagination,
					directionNav: carouselArrows,
					prevText: "",
					nextText: ""
				});
		});
	};
/* ==================================================
   Owl Carousel
================================================== */
	CAPITAL.OwlCarousel = function() {
		$('.owl-carousel').each(function(){
				var carouselInstance = $(this); 
				var carouselColumns = carouselInstance.attr("data-columns") ? carouselInstance.attr("data-columns") : "1";
				var carouselAutoplay = carouselInstance.attr("data-autoplay") === 'yes' ? true : false;
				var carouselAutoplayTime = carouselInstance.attr("data-autoplay-timeout") ? carouselInstance.attr("data-autoplay-timeout") : '5000';
				var carouselPagination = carouselInstance.attr("data-pagination") === 'yes' ? true : false;
				var carouselArrows = carouselInstance.attr("data-arrows") === 'yes' ? true : false;
				var carouselAutoHeight = carouselInstance.attr("data-auto-height") === 'yes' ? true : false;
				var carouselRTL = carouselInstance.attr("data-rtl") === 'yes' ? true : false;
				var carouselLoop = carouselInstance.attr("data-loop") === 'yes' ? true : false;
				var carouselMargin = carouselInstance.attr("data-margin") ? carouselInstance.attr("data-margin") : 25;
				var carouselPadding = carouselInstance.attr("data-padding") ? carouselInstance.attr("data-padding") : 0;
				
				carouselInstance.owlCarousel({
					loop: carouselLoop,
					items: carouselColumns,
					autoWidth: false,
					margin: parseInt(carouselMargin),
					stagePadding: parseInt(carouselPadding),
					autoplay : carouselAutoplay,
					autoplayTimeout: parseInt(carouselAutoplayTime),
					nav : carouselArrows,
					dots : carouselPagination,
					mergeFit: false,
					navText: ["<i class='mi mi-arrow-back'></i>","<i class='mi mi-arrow-forward'></i>"],
					autoplayHoverPause: true,
					lazyLoad: true,
					rtl: carouselRTL,
					autoHeight: carouselAutoHeight,
					responsive:{
						0:{
							items:1,
							dots:false,
							nav:false,
							stagePadding:0
						},
						768:{
							items:2,
							nav:false
						},
						1000:{
							items:carouselColumns
						},
						1200:{
							items:carouselColumns
						}
					}
				});
		});
	};
/* ==================================================
   Magnific Popup
================================================== */
	CAPITAL.Magnific = function() {
		jQuery('.format-gallery').each(function(){
			$(this).magnificPopup({
				delegate: 'a.popup-image', // child items selector, by clicking on it popup will open
				type: 'image',
				autoFocusLast: true,
				mainClass: 'mfp-with-zoom mfp-img-mobile',
				gallery:{enabled:true},
			});
		});
		jQuery('.magnific-image').magnificPopup({ 
			type: 'image',
			autoFocusLast: true,
			mainClass: 'mfp-with-zoom mfp-img-mobile',
			gallery:{enabled:false}
			// other options
		});
		jQuery('.magnific-video,.magnific-video button,.magnific-video a').magnificPopup({ 
			type: 'iframe',
			autoFocusLast: true,
			mainClass: 'mfp-with-zoom mfp-img-mobile',
			zoom: {
				enabled: true,
				duration: 300, // don't foget to change the duration also in CSS
				opener: function(element) {
				  return element.find('img');
				}
			},
			gallery:{enabled:false}
			// other options
		});
	};
/* ==================================================
   Animated Counters
================================================== */
	CAPITAL.Counters = function() {
		$('.cust-counter').each(function () {
			$(this).appear(function() {
			var counter = $(this).find(".timer .count").html();
			$(this).find(".timer .count").countTo({
				from: 0,
				to: counter,
				speed: 2000,
				refreshInterval: 60
				});
			});
		});
	};
/* ==================================================
   SuperFish menu
================================================== */
	CAPITAL.SuperFish = function() {
		$(".site-header").find(".dd-menu > li").clone().appendTo(".main-menu-clone > div > ul");
		$(".site-header").find(".dd-menu").clone().appendTo(".sticky-menu");
		$(".mmenu-toggle").on('click',function(){
			$(".mobile-menu").slideToggle();
			$(this).toggleClass('menu-opened');
		});
		if(!$('body').hasClass('header-style11')){
			$('.sf-menu').superfish({
				  delay: 200,
				  animation: {opacity:'show', height:'show'},
				  speed: 'fast',
				  cssArrows: false,
				  disableHI: true
			});
		}
		$('.theme-mobile-header .mobile-menu li.menu-item-has-children').each(function(){
			$(this).append('<span class="mesnopener"></span>');
		});
		$('.theme-mobile-header .mobile-menu li.menu-item-has-children .mesnopener').on('click',function(){
			$(this).parent('li').find('>ul.sub-menu').slideToggle();
			$(this).parent('li').toggleClass('mitem-clicked');
			return false;
		});
		$('.topbar-menu').tinyNav({
			header: '---',
			indent: '- '
		});
		// Centering the dropdown menus
		var a = $(".dd-style2.dd-menu li");
		a.mouseover(function() {
			 var the_width = $(this).find("a").width();
			 var child_width = $(this).find("ul").width();
			 var width = parseInt((child_width - the_width)/2);
			$(this).find("ul").css('left', -width);
		});
		
		var aa = $(".dd-menu li, .sticky-menu li");
        aa.each(function() {
            var aa = $(window).width() - 16, t = $(this).offset().left, o = $(this).find("ul.sub-menu").width(), n = 0;
            n = $("body").hasClass("boxed") ? imi_local.siteWidth - (t - (aa - imi_local.siteWidth) / 2) :aa - t;
            var d;
            $(this).find("ul.sub-menu").length > 0 && (d = n - o), (o > n || o > d) && ($(this).find("ul.sub-menu").addClass("right"),$(this).addClass("right-align-menu"), 
            $(this).find("ul.sub-menu").addClass("right"));
        });
		
		$('.hidden-menu-opener').on('click', function(){
			$('.main-menu').fadeToggle();
			$('body').addClass('fscreen-menu-open');
			return false;
		});
		
		CAPITAL.hs11hgetter = function() {
			var hs11theight = $('.header-style11 .site-header .header-top-blocks').height();
			var hs11bheight = $('.header-style11 .site-header .header-bottom-blocks').height();
			if($(window).height() < hs11theight+hs11bheight){
				$('.header-style11 .header-bottom-blocks').css({'position':'static','padding-left':0,'padding-right':0});
			}
		};
		
		$('.header-style11 .site-header .dd-menu li.menu-item-has-children').after().on('click',function(){
			$(this).find('> ul.sub-menu').slideToggle();
			$(this).toggleClass('menu-toggle-status');
			CAPITAL.hs11hgetter();
			return false;
		});
		
		$(window).resize(function(){
			CAPITAL.hs11hgetter();
		});
	};
/* ==================================================
   IsoTope Full Width
================================================== */
	CAPITAL.IsoTopeFull = function() {
        $("ul.sort-source").each(function() {
            var source = $(this);
            var destination = $("ul.sort-destination[data-sort-id=" + $(this).attr("data-sort-id") + "]");
            if(destination.get(0)) {
                $(window).load(function() {
                    destination.isotope({
                        itemSelector: ".grid-item",
                        layoutMode: 'sloppyMasonry'
                    });
                    source.closest(".sort-destination-parent > .sort-source").find("a").on("click", function(e) {
                        e.preventDefault();
                        var $this = $(this),
                            filter = $this.parent().attr("data-option-value");
                        source.find("li.active").removeClass("active");
                        $this.parent().addClass("active");
                        destination.isotope({
                            filter: filter
                        });
                        if(window.location.hash !== "" || filter.replace(".","") !== "*") {
                            self.location = "#" + filter.replace(".","");
                        }
                        return false;
                    });
                    var hashFilter = "." + (location.hash.replace("#","") || "*");
                    var initFilterEl = source.find("li[data-option-value='" + hashFilter + "'] a");
                    if(initFilterEl.get(0)) {
                        source.find("li[data-option-value='" + hashFilter + "'] a").click();
                    } else {
                        source.find("li:first-child a").click();
                    }
                });
            }
        });
		$(window).load(function() {
			var IsoTopeCont = $(".isotope-grid");
			IsoTopeCont.isotope({
				itemSelector: ".grid-item",
				layoutMode: 'sloppyMasonry'
			});
			if ($(".grid-holder").length > 0){	
				var $container_blog = $('.grid-holder');
				$container_blog.isotope({
					itemSelector : '.grid-item'
				});
				$(window).resize(function() {
					var $container_blog = $('.grid-holder');
					$container_blog.isotope({
						itemSelector : '.grid-item'
					});
				});
			}
		});
	};
/* ==================================================
   Pricing Tables
================================================== */
	var $tallestCol;
	CAPITAL.pricingTable = function(){
		$('.pricing-table').each(function(){
			$tallestCol = 0;
			$(this).find('> div .features').each(function(){
				($(this).height() > $tallestCol) ? $tallestCol = $(this).height() : $tallestCol = $tallestCol;
			});	
			if($tallestCol === 0){ $tallestCol = 'auto';}
			$(this).find('> div .features').css('height',$tallestCol);
		});
	};
/* ==================================================
   Equal Height
================================================== */
	CAPITAL.equalheight = function(){
		// apply matchHeight to each item container's items
		$('.equal-heighter').each(function() {
			$(this).find('.equal-height-column').matchHeight();
			$(this).find('.equal-height-column > div.vertical-center').flexVerticalCenter();
		});
	};
/* ==================================================
   Topbar Widgets Opener
================================================== */
	CAPITAL.Topbarwidgets = function(){
		var TopWidgetsWidth = imi_local.topbar_widgets;
		if(TopWidgetsWidth !== ''){
			var WidgetsWidth = TopWidgetsWidth;
		} else {
			var WidgetsWidth = '400px';
		}
		$('.widgets-at-top-opener').on('click',function(e){
			e.stopPropagation();
			$('body').addClass('topper-opened');
			$('.widgets-at-top').slideToggle();
			e.preventDefault();
		});
		$('.widgets-at-right-opener').on('click',function(e){
			e.stopPropagation();
			$('body').addClass('topper-opened');
			$('.widgets-at-right').animate({
				right: "0"
			},300);
			e.preventDefault();
		});
		$('.widgets-at-left-opener').on('click',function(e){
			e.stopPropagation();
			$('body').addClass('topper-opened');
			$('.widgets-at-left').animate({
				left: "0"
			},300);
			e.preventDefault();
		});
		$(document).on('click',function(){
			$('.widgets-at-right').animate({
				right: "-"+WidgetsWidth
			},300);
			$('.widgets-at-left').animate({
				left: "-"+WidgetsWidth
			},300);
			$('.widgets-at-top').slideUp();
			$('body').removeClass('topper-opened');
		});
		$(".widgets-at-left").on('click',function(e){
			e.stopPropagation();
		});
		$(".widgets-at-right").on('click',function(e){
			e.stopPropagation();
		});
		$(".widgets-at-top").on('click',function(e){
			e.stopPropagation();
		});
	};
/* ==================================================
   One Page Menu
================================================== */
	CAPITAL.OnePageMenu = function(){
		$(".page-template-template-onepage .menu-item").each(function(index, element) {
			var $menu_data_id = $(this).find("a").attr("data-id");
			var $home_url = window.location.href;
			if($(this).hasClass("menu-item-type-custom"))
			{

			}
			else
			{
				$(this).find("a").attr("href", window.location.href+"#scroll-"+$menu_data_id);
			}
		});
		if(Modernizr.touch && $(window).width() < 991 ) {
			$(".page-template-template-onepage .mobile-menu > div > ul > li > a").click(function(e){
				$(".mobile-menu").slideUp();
				e.preventDefault();
			});
		}
		
		//LOCAL SCROLL
		jQuery('.page-template-template-onepage .sf-menu, .page-template-template-onepage .mobile-menu').localScroll({
			offset: -62
		});

		var sections = jQuery('.page-template-template-onepage .page-section');
		var navigation_links = jQuery('.page-template-template-onepage .sf-menu a, .page-template-template-onepage .mobile-menu a');
		sections.waypoint({
			handler: function(direction) {
				var active_section;
				active_section = jQuery(this);
				if (direction === "up"){ active_section = active_section.prev();}
				var active_link = jQuery('.page-template-template-onepage .sf-menu a[href="'+ window.location.href + '#' + active_section.attr("id") + '"]');
				navigation_links.parent('li').removeClass("current-menu-item");
				active_link.parent('li').addClass("current-menu-item").delay(1500);
			},
			offset: 150
		});
	};
/* ==================================================
   Init Functions
================================================== */
$(document).ready(function(){
	CAPITAL.megaMenu();
	CAPITAL.scrollFunctions();
	CAPITAL.accordion();
	CAPITAL.toggle();
	CAPITAL.toolTip();
	CAPITAL.heroflex();
	CAPITAL.galleryflex();
	CAPITAL.OwlCarousel();
	CAPITAL.Magnific();
	CAPITAL.SuperFish();
	CAPITAL.Counters();
	CAPITAL.IsoTopeFull();
	CAPITAL.pricingTable();
	CAPITAL.OnePageMenu();
	CAPITAL.Topbarwidgets();
	$('.selectpicker').selectpicker({container:'body'});
	WWHGetter();
});

// DESIGN ELEMENTS //

// Any Button Scroll to section
$('a.scrollto, .scrollto a').on("click", function(){
	$.scrollTo( this.hash, 800, { easing:'easeOutQuint' });
	return false;
});

// Cart & Search option in header
$(".dd-search .search-module-trigger").on('click',function(e){
	e.stopPropagation();
	$(this).parents(".search-module").find(".search-module-opened").toggle();
 	$('.cart-module-opened').hide();
	e.preventDefault();
});
$(".dd-search .search-module-opened").on('click',function(e){
	e.stopPropagation();
});
$(".cart-module-trigger").on('click',function(e){
	e.stopPropagation();
	$(this).parents(".cart-module").find(".cart-module-opened").toggle();
 	$('.search-module-opened').hide();
	e.preventDefault();
});
$(".cart-module-opened").on('click',function(e){
	e.stopPropagation();
});
$(document).on('click',function(){
 	$('.search-module-opened, .cart-module-opened').hide();
});
$('.overlay-wrapper-close').on('click',function(){
	$('.overlay-wrapper').fadeOut();
	$('body').removeClass('overlay-wrapper-open');
	$('body').removeClass('fscreen-menu-open');
	return false;
});
$('.overlay-search-form .search-module-trigger').on('click', function(){
	setTimeout(function(){$('.overlay-search-form-wrapper input[type="text"]').focus();},500);
	$('.overlay-search-form-wrapper').fadeToggle();
	$('body').addClass('overlay-wrapper-open');
	return false;
});

// FITVIDS
$(".fw-video, .post-media").fitVids();

/* Circular Bars */
if(typeof($.fn.knob) !== "undefined") {
	$(".knob").knob({
		width: '100%'
	});
}

$(window).load(function(){
	$(".portfolio-item").show();
	CAPITAL.equalheight();
});
	
// Animation Appear
var AppDel;
function AppDelFunction($appd) {
	$appd.addClass("appear-animation");
	if(!$("html").hasClass("no-csstransitions") && $(window).width() > 767) {
		$appd.appear(function() {
			var delay = ($appd.attr("data-appear-animation-delay") ? $appd.attr("data-appear-animation-delay") : 1);
			if(delay > 1){ $appd.css("animation-delay", delay + "ms");}
			$appd.addClass($appd.attr("data-appear-animation"));
			setTimeout(function() {
				$appd.addClass("appear-animation-visible");
			}, delay);
			clearTimeout();
		}, {accX: 0, accY: -150});
	} else {
		$appd.addClass("appear-animation-visible");
	}
}
function AppDelStopFunction() {
	clearTimeout(AppDel);
}
$("[data-appear-animation]").each(function() {
	var $this = $(this);
	AppDelFunction($this);
	AppDelStopFunction();
});
// Animation Progress Bars

var AppAni;
function AppAniFunction($anim) {
	$anim.appear(function() {
		var delay = ($anim.attr("data-appear-animation-delay") ? $anim.attr("data-appear-animation-delay") : 1);
		if(delay > 1){ $anim.css("animation-delay", delay + "ms");}
		$anim.addClass($anim.attr("data-appear-animation"));
		setTimeout(function() {
			$anim.animate({
				width: $anim.attr("data-appear-progress-animation")
			}, 1500, "easeOutQuad", function() {
				$anim.find(".progress-bar-tooltip").animate({
					opacity: 1
				}, 500, "easeOutQuad");
				$anim.find(".progress-bar-perc").animate({
					opacity: 1
				}, 500, "easeOutQuad");
			});
		}, delay);
		clearTimeout();
	}, {accX: 0, accY: -50});
}
function AppAniStopFunction() {
	clearTimeout(AppAni);
}
$("[data-appear-progress-animation]").each(function() {
	var $this = $(this);
	AppAniFunction($this);
	AppAniStopFunction();
});

// Parallax Jquery Callings
if(!Modernizr.touch) {
	parallaxInit();
}
function parallaxInit() {
	$('.parallax1').parallax("50%", 0.1);
	$('.parallax2').parallax("50%", 0.1);
	$('.parallax3').parallax("50%", 0.1);
	$('.parallax4').parallax("50%", 0.1);
	$('.parallax5').parallax("50%", 0.1);
	$('.parallax6').parallax("50%", 0.1);
	$('.parallax7').parallax("50%", 0.1);
	$('.parallax8').parallax("50%", 0.1);
	/*add as necessary*/
}

// Window height/Width Getter Classes
function WWHGetter(){
	var wheighter = $(window).height();
	var wwidth = $(window).width();
	$(".wheighter").css("height",wheighter);
	$(".wwidth").css("width",wwidth);
}
});