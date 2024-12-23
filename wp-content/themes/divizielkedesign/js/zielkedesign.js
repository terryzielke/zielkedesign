(function($){
$(function(){

	/*
		GLOBAL VARIABLES
	*/
	var $window = $(window);

	var vw = $(window).width();
	$(window).resize(function(){
		vw = $(window).width();
	});


	/*
		SCROLL DETECTION
	*/
	$window.scroll(function() {
		// you are now scrolling
		var distance = $('#page').offset().top;
    if ( $window.scrollTop() > distance ) {
        $('body').addClass('you_see_me_scrolling');
    }else{
        $('body').removeClass('you_see_me_scrolling');
    }
	});

  
	/*
		SCROLL DIRECTION
	*/
	var lastScrollTop = 0, delta = 5;
	$(window).scroll(function(event){
		var st = $(this).scrollTop();
		
		if(Math.abs(lastScrollTop - st) <= delta)
		return;
		
		if (st > lastScrollTop){
			// downscroll code
			$('body').removeClass('scrolling_up');
		} else {
			// upscroll code
			$('body').addClass('scrolling_up');
		}
		lastScrollTop = st;
	});
	
	  
	/*
		TOGGLE PRIMARY MENU
	*/
	var	togTL = new TimelineLite({ paused:true });
		togTL.timeScale(1);
		togTL.add( "start")
		.to($('#menu-button .dot1'), .4, {top : '47%', ease:'back.in(1.7)'},'-=1')
		.to($('#menu-button .dot3'), .4, {bottom : '50%', ease:'back.in(1.7)'},'-=.4')
		.to($('#menu-button .dot2'), 0, {opacity : '0'})
		.to($('#menu-button .dot1'), .4, {rotate : '45deg', ease:'power2.in'},'-=.1')
		.to($('#menu-button .dot3'), .4, {rotate : '-45deg', ease:'power2.in'},'-=.4');
		
	// TRIGGERS
	$(document).on('click','#close-nav-curtain',zielkeToggleNavigation);
	$(document).on('click','#menu-button',zielkeToggleNavigation);
	function zielkeToggleNavigation(){
		if($('body').hasClass('open_navigation')){
			$('body').removeClass('open_navigation');
		}
		else{
			$('body').addClass('open_navigation');
		}
	}
	  
	  
	/*
		NEARBY EVENTS
	*/
	if($('#zielke-design-front-page-graphic svg').length){
		function lineEq(y2, y1, x2, x1, currentVal) {
			// y = mx + b
			var m = (y2 - y1) / (x2 - x1), b = y1 - m * x1;
			return m * currentVal + b;
		}
		var distanceThresholdLrg = {min: 0, max: 600};
		var distanceThreshold = {min: 0, max: 400};
		var distanceThresholdMid = {min: 0, max: 200};
		var distanceThresholdSml = {min: 0, max: 40};
		var colorInterval = {from: 0, to: 100};
		
		var i = 1;
		$('#zielke-design-front-page-graphic svg .light').each(function(){
			var $l = document.querySelector('#zielke-design-front-page-graphic svg .l' + i);
			new Nearby($l, {
				onProgress:  (distance)=>{
			
				var color = lineEq(colorInterval.from, colorInterval.to, distanceThreshold.max, distanceThreshold.min, distance);
				TweenMax.to($l, .5, {
					ease: 'Expo.easeOut',
					fill: 'hsl(204, ' + Math.max(color, colorInterval.from) + '%, 27%)'
				});
				
				}
			});
			i++;
		});
	}
	
	
	// JS hover effect
	$('#projects-wapper .project').mouseenter(function(){
		var $this = $(this);
		$('#projects-wapper .project').addClass('fade');
		$this.removeClass('fade');
	});
	$('#projects-wapper .project').mouseleave(function(){
		$('#projects-wapper .project').removeClass('fade');
	});

	
});
})(jQuery);



/* ---------------------------
	DIVI SMOOTH SCROLL TO ANCHOR
--------------------------- */
document.addEventListener('DOMContentLoaded', function(event){ 
    if (window.location.hash) {
        // Start at top of page
        window.scrollTo(0, 0);
		
        // Prevent default scroll to anchor by hiding the target element
        var db_hash_elem = document.getElementById(window.location.hash.substring(1));
        window.db_location_hash_style = db_hash_elem.style.display;
        db_hash_elem.style.display = 'none';
		
        // After a short delay, display the element and scroll to it
        jQuery(function($){
            setTimeout(function(){
                $(window.location.hash).css('display', window.db_location_hash_style);
                et_pb_smooth_scroll($(window.location.hash), false, 800);
            }, 700);
        });		
    }
});