<style>
	#select_block_table{
		list-style: none;
		margin: 12px 0 0;
		padding: 0;
		display: grid;
		grid-gap: 2px;
		grid-template-columns: 1fr 1fr 1fr 1fr 1fr 1fr;
	}
	#select_block_table li{
		width: 100%;
		height: 60px;
		text-align: center;
		line-height: 60px;
		margin: 0;
		background: lightgrey;
		border: grey;
		cursor: pointer;
	}
	#select_block_table li.selected{
		background-color: #00ff99;
	}
</style>

<?php
	/* EXERCISE NONCE */
	wp_nonce_field('goals_live_here_exercise_nonce', 'goals_live_here_exercise_nonce');
	/* meta fields */
	$selected_blocks_value = get_post_meta( $post->ID, 'selected_blocks_value', true );
?>
<input type="hidden" name="selected_blocks_value" id="selected_blocks_value" value="<?=$selected_blocks_value?>">


<ul id="select_block_table">
<?php
	$blocks = ['01','02','03','04','05','06','07','08','09','10','11','12'];
	
	foreach($blocks as $block):
		$block_array = explode('|', $selected_blocks_value);
		
		echo '<li value="'.$block.'" '.(in_array($block, $block_array) ? ' class="selected"' : '').'>
				<span>Block '.$block.'</span>
			</li>';

	endforeach;
?>
</ul>


<script>
	jQuery(document).ready(function($) {
		
		$(document).on('click','#select_block_table li',function(){
			// toggle class
			$(this).toggleClass('selected');
			// set select block variable
			var selected_blocks_value = '';
			// loop through all checkboxes
			setTimeout(function(){
				$('#select_block_table li').each(function(){
					var $this = $(this);
					var block_val = $this.val();
					
					if($this.hasClass('selected')){
						if(selected_blocks_value != ''){
							selected_blocks_value = selected_blocks_value + '|';
						}
						if(block_val <= 9){
							selected_blocks_value = selected_blocks_value + '0' + block_val;
						}
						else{
							selected_blocks_value = selected_blocks_value + block_val;
						}
					}
				});
				$('input#selected_blocks_value').val(selected_blocks_value);
			}, 200);
		});

	});
</script>