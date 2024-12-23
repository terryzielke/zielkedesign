<style>
	#quickslide_speed{
		width: 100%;
		margin: 8px 0 0;
	}
</style>
<?php
	$quickslide_speed = get_post_meta( $post->ID, 'quickslide_speed', true );
?>
<input type="number" name="quickslide_speed" id="quickslide_speed" value="<?=($quickslide_speed ? $quickslide_speed : '1')?>">