(function($){
$(function(){
	
	var	vh = $(window).height();
	var	vw = $(window).width();
	var	mobile = 500;
	
	
	/*
		ADJUST ASPECT RATIO
	*/
	$(document).ready(zdmd_adjustAspectRatio);
	$(window).resize(zdmd_adjustAspectRatio);
	
	function zdmd_adjustAspectRatio(){
		vh = $(window).height();
		vw = $(window).width();
		if((vh > vw) && (vw > mobile)){
			$('.monitor_and_mobile_mockup_wrapper').css('height','72vw');
			
			$('.monitormockup_wrapper .monitormockup_content').css({
				'width' : '90vw',
				'height' : '72vw'
			});
			$('.mobilemockup_wrapper').css({
				'bottom' : '0',
				'left' : 'calc(50% - 50vw)',
				'width' : '25vw',
				'height' : '50vw'
			});
		}
		else{
			$('.monitor_and_mobile_mockup_wrapper').removeAttr('style');
			$('.monitormockup_wrapper .monitormockup_content').removeAttr('style');
			$('.mobilemockup_wrapper').removeAttr('style');
		}
	}
	
	
	/*
		MOUSE ENTER MOCKUP
	*/
	$(document).on('mouseenter','.mm_mockup',function(){
		// SMOOTH SCROLL TO ANCHORS
		$('html, body').animate({
			scrollTop: $('.monitor_and_mobile_mockup_wrapper').offset().top + 0
		}, 800 );
	});
		
		
});
})(jQuery);