<?php
	function zielke_quickslide_shortcode($atts){
	
	/*
		SHORTCODE ATTRIBUTES
	*/
	$ID = $atts['id'];
	
	/*
  		GET CLIENT MOCKUPS
	*/
	$quickslide_speed = get_post_meta( $ID, 'quickslide_speed', true );
	$quickslide_images = get_post_meta( $ID, 'quickslide_images', true );
	$image_array = explode('|', $quickslide_images);
	
	/*
  		BUILD HTML
	*/
	$HTML = '<div class="quickslide-wrapper" speed="'.$quickslide_speed.'">';
	
	if($quickslide_images){
		foreach($image_array as $image){
			
			$image_url = wp_get_attachment_url($image);
			
			$HTML .= '<div class="slide"><figure style="background-image:url('.$image_url.');"></figure></div>';
		}
	}
	
	$HTML .= '</div>';
  
  return $HTML;
  
	}
	add_shortcode('quickslide', 'zielke_quickslide_shortcode');
?>