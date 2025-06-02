/*
 * Bones Scripts File
*/


/*
 * Get Viewport Dimensions
 * returns object with viewport dimensions to match css in width and height properties
 * ( source: http://andylangton.co.uk/blog/development/get-viewport-size-width-and-height-javascript )
*/
function updateViewportDimensions() {
	var w=window,d=document,e=d.documentElement,g=d.getElementsByTagName('body')[0],x=w.innerWidth||e.clientWidth||g.clientWidth,y=w.innerHeight||e.clientHeight||g.clientHeight;
	return { width:x,height:y };
}
// setting the viewport width
var viewport = updateViewportDimensions();


/*
 * Throttle Resize-triggered Events
 * Wrap your actions in this function to throttle the frequency of firing them off, for better performance, esp. on mobile.
 * ( source: http://stackoverflow.com/questions/2854407/javascript-jquery-window-resize-how-to-fire-after-the-resize-is-completed )
*/
var waitForFinalEvent = (function () {
	var timers = {};
	return function (callback, ms, uniqueId) {
		if (!uniqueId) { uniqueId = "Don't call this twice without a uniqueId"; }
		if (timers[uniqueId]) { clearTimeout (timers[uniqueId]); }
		timers[uniqueId] = setTimeout(callback, ms);
	};
})();

// how long to wait before deciding the resize has stopped, in ms. Around 50-100 should work ok.
var timeToWaitForLast = 100;


/*
 * Put all your regular jQuery in here.
*/
jQuery(document).ready(function($) {

// NAVI AUF UND ZU

var nav_toggle = $(".nav_toggle");

function toggle_menu(){

    $("body").toggleClass('menu_open');
    $("html").toggleClass('menu_open');

}

nav_toggle.click(function(){

  toggle_menu();

    $(".nav_container_mobile li").each(function (i) {
        var div = $(this);
        setTimeout(function () {
            div.toggleClass("animate_menu");
        }, i * 40);
    });

  return false;
});



$(function(){
 var shrinkHeader = 100;
  $(window).scroll(function() {
    var scroll = getCurrentScroll();
      if ( scroll >= shrinkHeader ) {
           $('#header').addClass('shrink');
        }
        else {
            $('#header').removeClass('shrink');
        }
  });
function getCurrentScroll() {
    return window.pageYOffset || document.documentElement.scrollTop;
    }
});

// Hide Header on on scroll down
var didScroll;
var lastScrollTop = 0;
var delta = 5;
var navbarHeight = $('header').outerHeight();

$(window).scroll(function(event){
    didScroll = true;
});

setInterval(function() {
    if (didScroll) {
        hasScrolled();
        didScroll = false;
    }
}, 250);

function hasScrolled() {
    var st = $(this).scrollTop();
    
    // Make sure they scroll more than delta
    if(Math.abs(lastScrollTop - st) <= delta)
        return;
    
    // If they scrolled down and are past the navbar, add class .nav-up.
    // This is necessary so you never see what is "behind" the navbar.
    if (st > lastScrollTop && st > navbarHeight){
        // Scroll Down
        $('header').removeClass('nav-down').addClass('nav-up');
    } else {
        // Scroll Up
        if(st + $(window).height() < $(document).height()) {
            $('header').removeClass('nav-up').addClass('nav-down');
        }
    }
    
    lastScrollTop = st;
}


    /////////////////////////////////////////////////////////////////
    // ANIMATIONS // ENTRANCES
    /////////////////////////////////////////////////////////////////


    //add intro animation to elements
    $(function () {
        $("h1, h2, .pre_heading, .cta_image_container, .header_text_container ").addClass("animation_element");

        //$(".post_image").append("<div class='animate_me'></div>");

        //$(".zal_animation_in").wrapInner("<span class='animate_me'></span>");
        //$(".zal_animation_in .animate_me").append("<span class='revealer'></span>"); // fix for Safari animation of ::after element. Sad. 

        // für jedes Element gucken ob im viewport 
        $('.animation_element').each(function () {


            if ($(this).isInViewport()) {
                $(this).addClass("in_view");
            } else {
                // $( this).removeClass("in_view");
            }
        });
    });

    /////////////////////////////////////////////
    // CHECK IF ANIMATION ELEMENTS ARE IN VIEWPORT
    /////////////////////////////////////////////
    var $window = $(window);

    $.fn.isInViewport = function () {
        var elementTop = $(this).offset().top;
        var elementBottom = elementTop + $(this).outerHeight();

        var viewportTop = $(window).scrollTop();
        var viewportBottom = viewportTop + $(window).height();

        return elementBottom > viewportTop && elementTop < viewportBottom;
    };


    // checken ob der obere teil unten rausfärht bei scroll up
    $.fn.isInViewportBottom = function () {
        var elementTop = $(this).offset().top;
        var elementBottom = elementTop + $(this).outerHeight();

        var viewportTop = $(window).scrollTop();
        var viewportBottom = viewportTop + $(window).height();

        return elementTop < viewportBottom;
    };


    var lastScrollTop = 0, delta = 5;
    $(window).scroll(function (event) {

    });


    // on scroll gucken ob sichtbar
    $(window).on('scroll', function () {
        var st = $(this).scrollTop();

        if (Math.abs(lastScrollTop - st) <= delta)
            return;
        // wenn richtung nach unten
        if (st > lastScrollTop) {
            // downscroll code

            $('.animation_element').each(function () {
                var activeColor = $(this).attr('id');

                if ($(this).isInViewport()) {
                    $(this).addClass("in_view");
                } else {
                    // $( this).removeClass("in_view");
                }
            });

        } else {
            // upscroll code für richtung nach oben

            $('.animation_element').each(function () {
                var activeColor = $(this).attr('id');

                if ($(this).isInViewportBottom()) {
                    $(this).addClass("in_view");
                } else {
                    // das hier wieder unkommentieren wenn sich Elemente mehrfach animieren sollen
                    // $( this).removeClass("in_view");
                }
            });
        }
        lastScrollTop = st;
    });

    // on load //resize checken ob sichtbar
    $(window).on('resize', function () {

        $('.animation_element').each(function () {
            var activeColor = $(this).attr('id');

            if ($(this).isInViewport()) {
                $(this).addClass("in_view");
            } else {
                // $( this).removeClass("in_view");
            }
        });
    });







}); /* end of as page load scripts */
