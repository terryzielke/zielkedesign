<style>
	#quickslide_selected_images{
		display: flex;
		flex-direction: row;
		flex-wrap: wrap;
	}
	#quickslide_selected_images figure{
		position: relative;
		display: inline-block;
		margin: 10px;
		width: 200px;
		height: 200px;
		background-size: cover;
		background-position: center;
		background-repeat: no-repeat;
	}
	#quickslide_selected_images figure span{
		position: absolute;
		top: 5px;
		right: 5px;
		width: 20px;
		height: 20px;
		text-align: center;
		line-height: 18px;
		font-weight: 800;
		color: #ff0099;
		background: white;
		border: 1px solid #eee;
		border-radius: 100px;
	}
	#quickslide_selected_images figure span:hover{
		border-color: #ff0099;
	}
</style>

<?php
	wp_enqueue_media();
	/* EXERCISE NONCE */
	wp_nonce_field('zielke_quickslide_nonce', 'zielke_quickslide_nonce');
	$quickslide_images = get_post_meta( $post->ID, 'quickslide_images', true );
	$image_array = explode('|', $quickslide_images);
?>
<input type="hidden" name="quickslide_images" id="quickslide_images" value="<?=$quickslide_images?>">

<div id="quickslide_selected_images">
<?php
	if($quickslide_images){
		foreach($image_array as $image){
			
			$image_url = wp_get_attachment_url($image);
			
			echo '<figure id="'.$image.'" style="background-image:url('.$image_url.');"><span class="delete">x</span></figure>';
		}
	}
?>
</div>
<a class="btn button" id="add_quicklide_images">Add Images</a>


<script>
	jQuery(document).ready(function($) {
	
	    $(document).on('click', '#add_quicklide_images', function(e) {
		  	var mediaUploader, json;
		  
		  	// use open instance of mediaUploader
		  	if ( undefined !== mediaUploader ) {
		  		mediaUploader.open();
		  		return;
		  	}
		  
		  	// create new instance of mediaUploader
		  	mediaUploader = wp.media.frames.mediaUploader = wp.media({
		  		frame:    'post',
		  		state:    'insert',
		  		multiple: true
		  	});
		  
		  	// setup an event handler for what to do when an image has been selected.
		    mediaUploader.on("insert", function(){
		  
		      var length = mediaUploader.state().get("selection").length;
		      var images = mediaUploader.state().get("selection").models
		  
		      for(var iii = 0; iii < length; iii++)
		      {
		          var image_url	= images[iii].changed.url;
		          var image_id	= images[iii].id;
		          var image_title	= images[iii].changed.title;
		          
				  $('#quickslide_selected_images').append('<figure id="' + image_id + '" style="background-image:url(' + image_url + ');"><span class="delete">x</span></figure>');
		      }
		      setTimeout(function(){
			     quickslide_update_images_meta(); 
		      }, 200);
		    });
		      
		  	// display mediaUploader
		  	mediaUploader.open();
	    });
	    
	    
	    /* UPDATE METADATA */
	    function quickslide_update_images_meta(){
		    
		    var image_ID_CSV = '';
		    
		    $('#quickslide_selected_images figure').each(function(){
			    
			    var id = $(this).attr('id');
			    
			    if(image_ID_CSV != ''){
				    image_ID_CSV = image_ID_CSV + '|';
			    }
			    image_ID_CSV = image_ID_CSV + id;
			    
		    });
		    
		    $('input#quickslide_images').val(image_ID_CSV);
	    }
	});
</script>