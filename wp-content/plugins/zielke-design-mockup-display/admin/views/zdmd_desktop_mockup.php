<?php
	// Set post nonce
	wp_nonce_field('zielke_design_mockup_display_nonce', 'zielke_design_mockup_display_nonce');
	// Get post meta data
	$desktop_mockup	= get_post_meta( $post->ID, 'desktop_mockup', true );
?>
<style>
  figure.desktop_mockup_select{
    margin: 0 !important;
  }
</style>

<input type="hidden" id="desktop_mockup" name="desktop_mockup" value="<?php if($desktop_mockup){ echo $desktop_mockup; } ?>" style=" width:100%;" />
<figure class="desktop_mockup_select">
  <img id="desktop_mockup_img" src="<?php if($desktop_mockup){ echo $desktop_mockup; } else{ echo 'https://via.placeholder.com/1000'; } ?>">
</figure>
<a class="desktop_mockup_select"><?php if($desktop_mockup){ echo 'Change Desktop Mockup'; }else{ echo 'Select Desktop Mockup'; } ?></a>