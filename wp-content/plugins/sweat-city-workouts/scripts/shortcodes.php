<?php
function sweat_city_workout(){
	
// Get the current user object
$current_user	= wp_get_current_user();
$username;$first_name;$last_name;
// Check if the user is logged in
if ( $current_user->exists() ) {
    // Get the username
    $user_id	= $current_user->ID;
    $user_login	= $current_user->user_login;
    $first_name	= $current_user->user_firstname;
    $last_name	= $current_user->user_lastname;
}
?>

<div id="sc-workout-wrapper">
	<?php
		
		// TODO:: if cookie exists display 'Continue Workout' button
		
		// Get all the terms for the 'equipment' taxonomy
		$all_equipment = get_terms(array(
		    'taxonomy'   => 'equipment',
		    'hide_empty' => false,
		));
        // Get the equipment associated with the current user
        $user_equipment = wp_get_object_terms($user_id, 'equipment', array('fields' => 'ids'));
		
	    // Start form output
	    ob_start(); // Start output buffering to return the form HTML
	    
		// Process the form submission
	    if (isset($_POST['submit_workout_gererator_form'])) {
	        // Security check (nonce for verification)
	        if (isset($_POST['update_user_taxonomy_nonce']) && wp_verify_nonce($_POST['update_user_taxonomy_nonce'], 'update_user_taxonomy_action')) {
		        
	            // Get the selected settings from the form
	            $selected_equipment = isset($_POST['user_equipment']) ? array_map('intval', $_POST['user_equipment']) : array();
				$selected_workout = $_POST['select_workout'];
				$selected_direction = $_POST['select_direction'];
	            // Update the user's selected terms
	            wp_set_object_terms($user_id, $selected_equipment, 'equipment');
				?>
					<div class="step step-2">
						<div id="user-directions">
							
						</div>
						<div id="user-interface" class="<?=($selected_direction == 'Self Directed' ? 'self-directed start block-01' : '')?>">
							<div id="ui-display">
								<div class="break">
									<h2>BREAK</h2>
								</div>
								<?php
									// create new class object
									$classBlock = new sweat_city_kickboxing_class($selected_equipment, $selected_workout);
									// block array
									$blocks = ['01','02','03','04','05','06','07','08','09','10','11','12'];
									$b = 1;
									foreach($blocks as $block){
										// start block html
										echo '<div class="block block-'.$block.'"><h2>BLOCK '.$b.'</h2>';
										$b++;
										
										if(in_array($block, ['04','05','08','09'])){
											// kickboxing blocks
											echo $classBlock->kickboxing_block($block);
										}
										elseif(in_array($block, ['12'])){
											// cooldown blocks
											echo $classBlock->cooldown_block($block);
										}
										else{
											// standard blocks
											echo $classBlock->standard_block($block);
										}
										// close block
										echo '</div>';
									}
								?>
							</div>
							<div id="ui-controls">
								<button id="ui-previous-block">&larr;</button>
								<div id="ui-timer-wrapper">
									<div id="ui-timer-txt"></div>
									<div id="ui-timer-bar"></div>
								</div>
								<button id="ui-next-block">&rarr;</button>
								<button id="ui-start">START</button>
							</div>
							<a href="" id="ui-stop">BACK</a>
						</div>
					</div>
				<?php
	        }
	    }
	    else{
			?>
			<div class="step step-1">
				<form method="POST" action="">
					<h2>Welcome <?=($first_name ? $first_name : $user_login)?></h2>
					<p><a class="set_available_equipment">Set available equipment</a></p>
					<div class="equipment">
						<?php
				            // Loop through each term and output it as a checkbox
				            foreach ($all_equipment as $term) {
				                ?>
				                <label>
				                    <input type="checkbox" name="user_equipment[]" value="<?php echo esc_attr($term->term_id); ?>" 
									<?php checked(in_array($term->term_id, $user_equipment)); ?> />
									<?php echo esc_html($term->name); ?>
				                </label><br/>
				                <?php
				            }
						?>
					</div>
					<div class="workout-type">
						<span class="fancy-select select-workout">
							<label for="select_workout" class="toggle-workout-list">
								<input type="text" name="select_workout" id="select_workout" value="Random Workout">
							</label>
							<ul class="fancy-options workout-list">
								<li class="fancy-option selected" value="Random Workout">Random Workout</li>
								<?php
									// Get all the terms for the 'workout' taxonomy
									$all_workouts = get_terms(array(
									    'taxonomy'   => 'workout',
									    'hide_empty' => false,
									));
						            // Loop through each term and output it as a checkbox
						            foreach ($all_workouts as $term) {
										echo '<li class="fancy-option" value="'.esc_html($term->name).'">'.esc_html($term->name).'</li>';
						            }
								?>
							</ul>
						</span>
					</div>
					<div class="direction-type">
						<span class="fancy-select select-direction">
							<label for="select_direction" class="toggle-direction-list">
								<input type="text" name="select_direction" id="select_direction" value="Self Directed">
							</label>
							<ul class="fancy-options direction-list">
								<li class="fancy-option selected" value="self_directed">Self Directed</li>
								<li class="fancy-option" value="time_directed">Timed</li>
							</ul>
						</span>
					</div>
					<div class="submition">
						<?php
				            // Add nonce for security
				            wp_nonce_field('update_user_taxonomy_action', 'update_user_taxonomy_nonce');
			            ?>
						<input type="submit" name="submit_workout_gererator_form" id="submit_workout_gererator_form" class="btn button" value="Generate Workout" />
					</div>
				</form>
			</div>
			<?php
	    }
	    // End output buffering and return the form HTML
		return ob_get_clean();
	?>
</div>

<?php
}
// Create a nonce for the form to prevent CSRF attacks
function add_user_taxonomy_nonce_field() {
    wp_nonce_field('update_user_taxonomy_action');
}
add_action('sweat_city_workout', 'add_user_taxonomy_nonce_field');
// Register the shortcode to display the form
add_shortcode( 'sweat_city_workout', 'sweat_city_workout' );
?>