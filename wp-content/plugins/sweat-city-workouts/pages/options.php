<?php
	if(isset($_REQUEST['submit_block_settings'])){
		
		// get all block arrays
		$block_01_str = $_POST['block_01_exercise'];
		$block_01_arr = explode('|', $block_01_str);
		
		$block_02_str = $_POST['block_02_exercise'];
		$block_02_arr = explode('|', $block_02_str);
		
		$block_03_str = $_POST['block_03_exercise'];
		$block_03_arr = explode('|', $block_03_str);
		
		$block_04_str = $_POST['block_04_exercise'];
		$block_04_arr = explode('|', $block_04_str);
		
		$block_05_str = $_POST['block_05_exercise'];
		$block_05_arr = explode('|', $block_05_str);
		
		$block_06_str = $_POST['block_06_exercise'];
		$block_06_arr = explode('|', $block_06_str);
		
		$block_07_str = $_POST['block_07_exercise'];
		$block_07_arr = explode('|', $block_07_str);
		
		$block_08_str = $_POST['block_08_exercise'];
		$block_08_arr = explode('|', $block_08_str);
		
		$block_09_str = $_POST['block_09_exercise'];
		$block_09_arr = explode('|', $block_09_str);
		
		$block_10_str = $_POST['block_10_exercise'];
		$block_10_arr = explode('|', $block_10_str);
		
		$block_11_str = $_POST['block_11_exercise'];
		$block_11_arr = explode('|', $block_11_str);
		
		$block_12_str = $_POST['block_12_exercise'];
		$block_12_arr = explode('|', $block_12_str);

		// loop through all exercises
		$exercise_query_args = array(
			'post_type'			=> 'exercise',
			'status'			=> 'publish',
			'posts_per_page'	=> -1
		);
		$query = new WP_Query($exercise_query_args);
		if ($query->have_posts()){
			// explode block into array
			while ($query->have_posts()) {
				$query->the_post();
				$x_ID					= get_the_ID();
				$selected_blocks_value	= '';
				
				// check for ID in each block
				if(in_array($x_ID, $block_01_arr)){
					$selected_blocks_value .= '01';
				}
				if(in_array($x_ID, $block_02_arr)){
					$selected_blocks_value .= ($selected_blocks_value != '' ? '|' :'').'02';
				}
				if(in_array($x_ID, $block_03_arr)){
					$selected_blocks_value .= ($selected_blocks_value != '' ? '|' :'').'03';
				}
				if(in_array($x_ID, $block_04_arr)){
					$selected_blocks_value .= ($selected_blocks_value != '' ? '|' :'').'04';
				}
				if(in_array($x_ID, $block_05_arr)){
					$selected_blocks_value .= ($selected_blocks_value != '' ? '|' :'').'05';
				}
				if(in_array($x_ID, $block_06_arr)){
					$selected_blocks_value .= ($selected_blocks_value != '' ? '|' :'').'06';
				}
				if(in_array($x_ID, $block_07_arr)){
					$selected_blocks_value .= ($selected_blocks_value != '' ? '|' :'').'07';
				}
				if(in_array($x_ID, $block_08_arr)){
					$selected_blocks_value .= ($selected_blocks_value != '' ? '|' :'').'08';
				}
				if(in_array($x_ID, $block_09_arr)){
					$selected_blocks_value .= ($selected_blocks_value != '' ? '|' :'').'09';
				}
				if(in_array($x_ID, $block_10_arr)){
					$selected_blocks_value .= ($selected_blocks_value != '' ? '|' :'').'10';
				}
				if(in_array($x_ID, $block_11_arr)){
					$selected_blocks_value .= ($selected_blocks_value != '' ? '|' :'').'11';
				}
				if(in_array($x_ID, $block_12_arr)){
					$selected_blocks_value .= ($selected_blocks_value != '' ? '|' :'').'12';
				}
				// Update the post meta
				update_post_meta($x_ID, 'selected_blocks_value', $selected_blocks_value);
			}
		}
		wp_reset_postdata();
	}
?>
<style>
	fieldset{
		width: calc(100% - 60px);
		margin-bottom: 20px;
		padding: 20px;
		background: white;
		border: 1px solid lightgrey;
	}
	fieldset h2{
		margin-top: 0;
	}
	fieldset .exercise-select-wrapper{
		display: block;
		max-width: 1000px;
	}
	fieldset .exercise-select-wrapper input.exercise-filter{
		-webkit-appearance: none;
		border-radius: 0;
		margin: 0;
		width: 100%;
		border: 1px solid lightgrey;
	}
	fieldset .exercise-select-wrapper table{
		display: block;
		width: 100%;
		border-collapse: collapse;
		border-spacing: 0;
	}
	fieldset .exercise-select-wrapper table tbody{
		display: block;
		width: 100%;
	}
	fieldset .exercise-select-wrapper table tbody tr{
		display: flex;
		width: 100%;
	}
	fieldset .exercise-select-wrapper table tbody tr td{
		display: block;
		flex: 1;
		padding: 10px 0;
		border: 1px solid lightgrey;
		border-top: none;
	}
	fieldset .exercise-select-wrapper table tbody tr td:nth-child(1){
		border-right: none;
	}
	fieldset .exercise-select-wrapper table tbody tr td ul{
		list-style: none;
		margin: 0;
		padding: 0;
		height: 200px;
		overflow-y: scroll;
	}
	fieldset .exercise-select-wrapper table tbody tr td ul li{
		position: relative;
		margin: 0;
		padding: 0;
		background: #FFFFFF;
		cursor: pointer !important;
	}
	fieldset .exercise-select-wrapper table tbody tr td ul li.selected{
		opacity: .2;
	}
	fieldset .exercise-select-wrapper table tbody tr td ul li:not(.selected):hover{
		background: #EEEEEE;
	}
	fieldset .exercise-select-wrapper table tbody tr td ul li .left-or-right{
		display: inline-block;
		width: 20px;
		opacity: .3;
		font-weight: 900;
	}
	fieldset .exercise-select-wrapper table tbody tr td ul li .delete{
		position: absolute;
		top: 0;
		right: 0;
		width: 20px;
		height: 20px;
		line-height: 20px;
		text-align: center;
		font-weight: 900;
		color: #ff0099;
		border-radius: 3px;
		cursor: pointer !important;
		margin: 4px;
	}
	fieldset .exercise-select-wrapper table tbody tr td ul li .delete:hover{
		background: #ff0099;
		color: white;
	}
	fieldset .exercise-select-wrapper table tbody tr td ul.available-exercises li{
		display: flex;
		flex-direction: row;
	}
	fieldset .exercise-select-wrapper table tbody tr td ul.available-exercises li div{
		flex: 1;
		padding: 5px 10px;
	}
	fieldset .exercise-select-wrapper table tbody tr td ul.selected-exercises li{
		padding: 5px 10px;
	}
	.clicktocopy{
		cursor: pointer !important;
	}
	.clicktocopy span{
		padding: 0 5px;
		opacity: .5;
	}
</style>

<h1>Block Settings</h1>
<p>Select all the exercises available for each Block.</p>
<p>Place this shortcode on the page where you want to display the workout generator: <span class="clicktocopy">[sweat_city_workout]</span></p>


<form method="post" action="" enctype="multipart/form-data">
<?php
	// database
	global $wpdb;
	
		// block array
		$blocks = ['01','02','03','04','05','06','07','08','09','10','11','12'];
		
		foreach($blocks as $block):
		?>
	
			<fieldset>
				<h2>Block <?=$block?></h2>
				<div class="exercise-select-wrapper">
					<input type="hidden" class="block_number_exercise" name="block_<?=$block?>_exercise" value="<?=$block_exercises?>">
					<input type="text" class="exercise-filter" placeholder="search exercises">
					<table>
						<tbody>
							<tr>
								<td>
									<ul class="available-exercises">
										<?php
											
											// set query args
											$exercise_query_args = array(
												'post_type'			=> 'exercise',
												'status'			=> 'publish',
												'posts_per_page'	=> -1
											);
											$query = new WP_Query($exercise_query_args);
											if ($query->have_posts()){
												// explode block into array
												while ($query->have_posts()) {
													$query->the_post();
													// get meta fields
													$x_ID					= get_the_ID();
													$selected_blocks_value	= strtolower(get_post_meta( $x_ID, 'selected_blocks_value', true ));
													$selected_blocks_array	= explode('|', $selected_blocks_value);
													$left_or_right			= strtolower(get_post_meta( $x_ID, 'left_or_right', true ));
													// get terms
													$workout_terms			= get_the_terms($x_ID, 'workout');
													if(!empty($workout_terms) && !is_wp_error($workout_terms)){
														$workout_list		= wp_list_pluck($workout_terms, 'name');
													}
													// output all exercises
													echo '<li class="exercise'.(in_array($block, $selected_blocks_array) ? ' selected' : '').'" x_id="'.$x_ID.'">
															<div class="col1">'.
																($left_or_right == 'none' || $left_or_right == '' ? '' : ($left_or_right == 'left' ? '<span class="left-or-right">&larr;</span>' : '<span class="left-or-right">&rarr;</span>')).
																get_the_title($x_ID).
															'</div>
															<div class="col2">'.
																($workout_list ? implode(', ', $workout_list) : '').
															'</div>
														</lil>';
												}
											}
											wp_reset_postdata();
											
										?>
									</ul>
								</td>
								<td>
									<ul class="selected-exercises">
										<?php
											
											// set query args
											$exercise_query_args = array(
												'post_type'			=> 'exercise',
												'status'			=> 'publish',
												'posts_per_page'	=> -1,
										        'meta_query'     => array(
										            array(
										                'key'     => 'selected_blocks_value',
										                'value'   => $block,
										                'compare' => 'LIKE'
										            )
										        )
											);
											$query = new WP_Query($exercise_query_args);
											if ($query->have_posts()){
												// explode block into array
												while ($query->have_posts()) {
													$query->the_post();
													$x_ID				= get_the_ID();
													$left_or_right		= strtolower(get_post_meta( $x_ID, 'left_or_right', true ));
													// output block exercises only
													//if(in_array($block, $exercise_blocks){
														echo '<li class="exercise" x_id="'.$x_ID.'">'.
																($left_or_right == 'none' || $left_or_right == '' ? '' : ($left_or_right == 'left' ? '<span class="left-or-right">&larr;</span>' : '<span class="left-or-right">&rarr;</span>')).
																get_the_title($x_ID).
																'<span class="delete">-</span>
															</lil>';
													//}
												}
											}
											wp_reset_postdata();
											
										?>
									</ul>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</fieldset>

		<?php
		endforeach;
?>

<input type="submit" class="button btn primary" name="submit_block_settings" id="submit_block_settings" value="Save Block Settings">
</form>


<script>
(function($){
$(function(){
	
	// set exercises for each block on page load
	$(document).ready(set_exercises_for_all_blocks);
	
	// click to copy shortcode
    $(".clicktocopy").on("click", function() {
        // Get the HTML content of the clicked element
        var content = $(this).html();
        // Create a temporary textarea element to store the HTML content
        var $temp = $("<textarea>");
        $("body").append($temp);
        $temp.val(content).select();
        // Execute the copy command
        document.execCommand("copy");
        // Remove the temporary textarea element
        $temp.remove();
        // Optionally, show an alert or notification to indicate content has been copied
        $(this).append('<span>(coppied)</span>');
    });
	
	// add exercise
	$(document).on('click','.available-exercises li',function(){
		var $this = $(this);
		if(!$this.hasClass('selected')){
			// grey out list item
			$this.addClass('selected');
			var x_id = $this.attr('x_id');
			var x_title = $this.html();
			// append list item to selected list
			$this.closest('.exercise-select-wrapper').find('.selected-exercises').append('<li class="exercise" x_id="' + x_id + '">' + x_title + '<span class="delete">-</span></lil>');
			// call functions
			setTimeout(function(){
				set_exercises_for_all_blocks();
			}, 200);
		}
	});
	
	// remove exercise
	$(document).on('click','.selected-exercises li .delete',function(){
		var $this = $(this).closest('li');
		var x_id = $this.attr('x_id');
		$this.closest('.exercise-select-wrapper').find('.available-exercises li[x_id="' + x_id + '"]').removeClass('selected');
		$this.remove();
		// call functions
		setTimeout(function(){
			set_exercises_for_all_blocks();
		}, 200);
	});
	
	// filter exercises
	$(document).on('keyup','input.exercise-filter',function(){
		var $this = $(this);
		var filterVal = $this.val().toLowerCase();
		if(filterVal != ''){
			$this.closest('.exercise-select-wrapper').find('.available-exercises li').each(function(){
				var $exercise = $(this);
				var exerciseVal = $exercise.html().toLowerCase();
				if(~exerciseVal.indexOf(filterVal)){
					$exercise.css('display','flex');
				}
				else{
					$exercise.css('display','none');
				}
			});
		}
		else{
			$this.closest('.exercise-select-wrapper').find('.available-exercises li').css('display','flex');
		}
	});
	
	// function set exercise array for all blocks, to be used in post update
	function set_exercises_for_all_blocks(){
		$('.exercise-select-wrapper').each(function(){
			// set input element
			var $input = $(this).find('input.block_number_exercise');
			var block_number_exercise = '';
			// loop through selected sxercises
			$(this).find('.selected-exercises li').each(function(){
				// add ID to block array
				if(block_number_exercise != ''){
					block_number_exercise = block_number_exercise + '|';
				}
				block_number_exercise = block_number_exercise + $(this).attr('x_id');
			});
			$input.val(block_number_exercise);
		});
	}
	
});
})(jQuery);
</script>