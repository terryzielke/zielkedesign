(function($){
$(function(){
	
	$(document).ready(function () {
	    let $images = $('.quickslide-wrapper .slide'); // Select all images within #quickimages
	    let index = 0; // Start with the first image
	
	    function showNextImage() {
	        $images.hide(); // Hide all images
	        $images.eq(index).show(); // Show the current image
	        index = (index + 1) % $images.length; // Move to the next image, looping back to the start
	    }
	
	    // Initial display and start the interval
	    showNextImage();
	    setInterval(showNextImage, 1000); // Change image every 1 second
	});

});
})(jQuery);