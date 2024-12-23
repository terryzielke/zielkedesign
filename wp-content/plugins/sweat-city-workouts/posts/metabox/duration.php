<style>
	#duration{
		width: 100%;
		margin: 8px 0 0;
	}
</style>
<?php
	$duration = get_post_meta( $post->ID, 'duration', true );
?>
<input type="number" name="duration" id="duration" step=".01" value="<?=($duration ? $duration : '.3')?>">