<?php
	$light_dark = get_post_meta( $post->ID, 'light_dark', true );
?>
<p>
<label for="light_dark_light"><input type="radio" name="light_dark" id="light_dark_light" value="light" <?php if($light_dark == 'light'){echo ' checked="checked"';} ?>><span>Light</span></label>
</p>
<p>
<label for="light_dark_dark"><input type="radio" name="light_dark" id="light_dark_dark" value="dark" <?php if($light_dark == 'dark'){echo ' checked="checked"';} ?>><span>Dark</span></label>
</p>