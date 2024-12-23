
/*
	DISPLAY MEDIA UPLOADER
*/

function zdmdRenderMediaUploader( $ ) {
	'use strict';
	var mediaUploader;

	/*
		USE PRE-EXISTING INSTANCE
	*/
	if ( undefined !== mediaUploader ) {
		mediaUploader.open();
		return;
	}

	/*
		CREATE A NEW INSTANCE.
	*/
	mediaUploader = wp.media.frames.mediaUploader = wp.media({
		frame:    'post',
		state:    'insert',
		multiple: false
	});

	/*
		DISPLAY THE MEDIA UPLOADER
	*/
	mediaUploader.open();
	
	/*
		INSERT IMAGE
		
		Setup an event handler for what to do when 
		an image has been selected.
	*/
    mediaUploader.on("insert", function(){

        var length = mediaUploader.state().get("selection").length;
        var images = mediaUploader.state().get("selection").models

        for(var iii = 0; iii < length; iii++)
        {
            var image_url	= images[iii].changed.url;
            var image_id	= images[iii].id;
            var image_title	= images[iii].changed.title;
            // insert media data into post
				
            $('input#desktop_mockup').val(image_url);
            $('img#desktop_mockup_img').attr('src', image_url);
            
			zdmdSetGallerySCV( $ );
			
        }
    });
}

/*
	EVENT TO OPEN MEDIA UPLOADER
*/
(function( $ ) {
	'use strict';
	$(function() {

		$( '.desktop_mockup_select' ).on( 'click', function( evt ) {
			// stop the default behavior
			evt.preventDefault();
			// display the media uploader
			zdmdRenderMediaUploader( $ );
		});

	});
})( jQuery );