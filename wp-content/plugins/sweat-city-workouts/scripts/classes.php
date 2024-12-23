<?php
class sweat_city_kickboxing_class {
    // Properties
    public $equipment;
    public $workout;
    // Constructor
    public function __construct($selected_equipment, $select_workout) {
        $this->equipment = $selected_equipment;
        $this->workout = $select_workout;
    }
    
    // TODO:: add exercise description
    // TODO:: add exercise diagram
    // TODO:: check users equipment
    
    /*
	    STANDARD BLOCK
    */
    public function standard_block($block) {
	    $max_duration = 3;
		$block_duration = 0;
		$block_sequence = '';
		
		// get randomized array of exercises for this block
		$args = array(
	        'post_type'      => 'exercise',
	        'posts_per_page' => -1,
	        'orderby'        => 'rand',
	        'meta_query'     => array(
	            array(
	                'key'     => 'selected_blocks_value',
	                'value'   => $block,
	                'compare' => 'LIKE'
	            )
	        )
	    );
	    $query = new WP_Query($args);
	    
	    if ($query->have_posts()) {
	        while ($query->have_posts()) {
	            $query->the_post();
	            
				// Get the exercise data
				$exercise_duration = get_post_meta( get_the_ID(), 'duration', true );
				$exercise_equipment = wp_get_post_terms(get_the_ID(), 'equipment');
				// Extract the term IDs from the equipment
				$equipment_ID_array = wp_list_pluck($exercise_equipment, 'term_id');
				// Find the intersection (common IDs)
				$matching_equipment_IDs = array_intersect($equipment_ID_array, $this->equipment);
				// if there are matching IDs
				if(!empty($matching_equipment_IDs) || empty($exercise_equipment)){
					
					// build workout sequence
					if($block_duration < $max_duration){
						
						// calculate exercise repetitions
						$min_rep_count = 6;
						$max_rep_count = 20;
						$exercise_repetitions = rand($min_rep_count, $max_rep_count);
						// check if the repetition value is even
						if($exercise_repetitions % 2 === 0){
							// do nothing if the repetition value is even
						}
						else{
							$exercise_repetitions = $exercise_repetitions - 1;
						}
						// get remaining block duration
						$remaining_duration = $max_duration - $block_duration;
						// get exercise and repetion duration to block_duration
						$repetition_duration = $exercise_duration * $exercise_repetitions;
						// if there is enough time remaining in block duration
						if($remaining_duration >= $repetition_duration){
							// output exercise
							if($block_sequence != ''){
								$block_sequence .= '<b>+</b>';
							}
					        $block_sequence .= '<span class="exercise"><span class="reps">' . $exercise_repetitions . '</span>' . get_the_title() . '</span>';
							// add exercise and repetion duration to block_duration
							$block_duration = $block_duration + $repetition_duration;
						}
					}
				}
	        }
	    }
	    
	    // return block sequence
		echo $block_sequence;
    }
    
    /*
	    COOLDOWN BLOCK
    */
    public function cooldown_block($block) {
	    $max_duration = 3;
		$block_duration = 0;
		$block_sequence = '';
		
		// get randomized array of exercises for this block
		$args = array(
	        'post_type'      => 'exercise',
	        'posts_per_page' => 3,
	        'orderby'        => 'rand',
	        'meta_query'     => array(
	            array(
	                'key'     => 'selected_blocks_value',
	                'value'   => 12,
	                'compare' => 'LIKE'
	            )
	        )
	    );
	    $query = new WP_Query($args);
	    
	    if ($query->have_posts()) {
	        while ($query->have_posts()) {
	            $query->the_post();
				
				// output exercise
				if($block_sequence != ''){
					$block_sequence .= '<b>+</b>';
				}
		        $block_sequence .= '<span class="exercise">' . get_the_title() . '</span>';
	        }
	    }
	    
	    // return block sequence
		echo $block_sequence;
    }
    
    /*
	    KICKBOXING BLOCK
    */
    public function kickboxing_block($block) {
	    $max_duration = 3;
		$block_duration = 0;
		$block_sequence = '';
		$side = 'left';
		
		// get randomized array of exercises for this block
		$args = array(
	        'post_type'      => 'exercise',
	        'posts_per_page' => -1,
	        'orderby'        => 'rand',
	        'meta_query'     => array(
	            array(
	                'key'     => 'selected_blocks_value',
	                'value'   => $block,
	                'compare' => 'LIKE'
	            )
	        )
	    );
	    $query = new WP_Query($args);
	    
	    if ($query->have_posts()) {
	        while ($query->have_posts()) {
	            $query->the_post();
	            
				// Get the exercise data
				$exercise_duration = get_post_meta( get_the_ID(), 'duration', true );
				$exercise_side = strtolower( get_post_meta( get_the_ID(), 'left_or_right', true ) );
				$exercise_equipment = wp_get_post_terms(get_the_ID(), 'equipment');
				// Extract the term IDs from the equipment
				$equipment_ID_array = wp_list_pluck($exercise_equipment, 'term_id');
				// Find the intersection (common IDs)
				$matching_equipment_IDs = array_intersect($equipment_ID_array, $this->equipment);
				// if there are matching IDs
				if(!empty($matching_equipment_IDs) || empty($exercise_equipment)){
					
					// build workout sequence
					if($block_duration < $max_duration){
						
				        // change side variable
				        if($side == $exercise_side){
					        // add a + between exercises
							if($block_sequence != ''){
								$block_sequence .= '<b> + </b>';
							}
							// add exercise to sequence
					        $block_sequence .= '<span class="hit">' . get_the_title() . '</span>';
					        // add exercise duration to block duration
					        $block_duration = $block_duration + $exercise_duration;
							// change side variable
					        if($side == 'left'){
						        $side = 'right';
					        }
					        elseif($side == 'right'){
						        $side = 'left';
					        }
				        }
					}
				}
	        }
	    }
	    
	    // return block sequence
		echo $block_sequence;
    }
    
    public function calculate_exercise_repetition(){
	    
    }
}
?>
