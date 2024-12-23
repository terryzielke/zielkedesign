<style>
	#left_or_right{
		margin: 8px 0 0;
		width: 100%;
	}
</style>


<?php
	$left_or_right = get_post_meta( $post->ID, 'left_or_right', true );
?>
<select name="left_or_right" id="left_or_right">
	<option value="none" <?=($left_or_right == 'none' || !$left_or_right ? ' selected="selected"' : '')?>>None</option>
	<option value="left" <?=($left_or_right == 'left' ? ' selected="selected"' : '')?>>Left</option>
	<option value="right" <?=($left_or_right == 'right' ? ' selected="selected"' : '')?>>Right</option>
</select>