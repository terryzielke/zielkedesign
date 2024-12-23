<?php
	function zielke_mockup_shortcode($atts){
	
	/*
		SHORTCODE ATTRIBUTES
	*/
	$clientID = $atts['id'];
	
	/*
  	GET CLIENT MOCKUPS
	*/
	$color = get_post_meta( $clientID, 'light_dark', true );
	$desktop_mockup = get_post_meta( $clientID, 'desktop_mockup', true );
	$mobile_mockup = get_the_post_thumbnail_url($clientID);
	
	// if mockups are scaled down by WP library
	$desktop_mockup = str_replace('-scaled', '', $desktop_mockup);
	$mobile_mockup = str_replace('-scaled', '', $mobile_mockup);
	
	/*
  	BUILD HTML
	*/
	$HTML = '<div class="monitor_and_mobile_mockup_wrapper">';
	
	// monitor
  if($desktop_mockup){
  	$HTML .= '<div class="monitormockup_wrapper">
            	<div class="monitormockup_content">
              	<div class="mm_monitor">
              	  <img src="/wp-content/plugins/zielke-design-mockup-display/assets/'.($color == 'light' || $color == '' ? 'empty-monitor.png' : 'empty-monitor-dark.png').'">
                </div>
                <div class="mm_mockup">
                  <img src="'.$desktop_mockup.'">
                </div>
              </div>
            </div>';
  }
  // mobile
  if($mobile_mockup){
    $HTML .= '<div class="mobilemockup_wrapper">
            	<div class="mobilemockup_content">
              	<div class="mm_mobile">
              	  <img src="/wp-content/plugins/zielke-design-mockup-display/assets/'.($color == 'light' || $color == '' ? 'empty-phone.png' : 'empty-phone-dark.png').'">
                </div>
                <div class="mm_mockup">
                  <img src="'.$mobile_mockup.'">
                </div>
              </div>
            </div>';
  }
  $HTML .= '</div>';
  
  return $HTML;
  
	}
	add_shortcode('zielke_mockup', 'zielke_mockup_shortcode');
?>