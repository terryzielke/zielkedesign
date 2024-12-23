<?php
	
/* Add metaboxs to exercise post type */
add_action( 'add_meta_boxes', 'sc_exercise_meta_boxs' );
function sc_exercise_meta_boxs() {
	add_meta_box(
		'assigned-blocks',	// box id
		'Assigned Blocks',	// box title
		'assigned_blocks',	// box html
		'exercise',			// post_types
		'normal'			// box location
	);
	add_meta_box(
		'left-or-right',
		'Left or Right',
		'left_or_right',
		'exercise',
		'side'
	);
	add_meta_box(
		'exercise-duration',
		'Exercise Duration (min)',
		'duration',
		'exercise',
		'side'
	);
}
// callback functions
function assigned_blocks( $post ) {
	include('metabox/assigned_blocks.php');
}
function left_or_right( $post ) {
	include('metabox/left_or_right.php');
}
function duration( $post ) {
	include('metabox/duration.php');
}


/* Save exercise metadata */
add_action( 'save_post', 'sc_save_exercise_meta_data' );
function sc_save_exercise_meta_data( $post_id ){
	// Check for varified nonce
	if ( ! isset( $_POST['goals_live_here_exercise_nonce'] ) ||
		! wp_verify_nonce( $_POST['goals_live_here_exercise_nonce'], 'goals_live_here_exercise_nonce' ) ){
		return;
	}else{
		// post meta
		if ( isset($_REQUEST['left_or_right']) ) {
	  		update_post_meta($post_id, 'left_or_right', sanitize_text_field($_REQUEST['left_or_right']) );
	    }
		if ( isset($_REQUEST['duration']) ) {
	  		update_post_meta($post_id, 'duration', sanitize_text_field($_REQUEST['duration']) );
	    }
		if ( isset($_REQUEST['selected_blocks_value']) ) {
	  		update_post_meta($post_id, 'selected_blocks_value', sanitize_text_field($_REQUEST['selected_blocks_value']) );
	    }
	}
}


/* CREATE CUSTOM COLOMNS */
add_filter( 'manage_edit-exercise_columns', 'sc_add_exercise_custom_columns' );
function sc_add_exercise_custom_columns( $columns ){
	$columns = array(
		'cb'							=> '<input type="checkbox" />',
		'title'							=> __( 'Exercise' ),
		'workout'			  			=> __( 'Workout' ),
		'side'				  			=> __( 'Side' ),
		'date'							=> __( 'Date' )
	);
	return $columns;
}
/* ADD CUSTOM COLUMN DATA */
add_action( 'manage_exercise_posts_custom_column' , 'sc_add_exercise_custom_column_data', 10, 2 );
function sc_add_exercise_custom_column_data( $column, $post_id ) {
	$left_or_right	= get_post_meta( $post_id, 'left_or_right', true );
	$workout_terms	= get_the_terms($post_id, 'workout');
	if(!empty($workout_terms) && !is_wp_error($workout_terms)){
		$workout_list = wp_list_pluck($workout_terms, 'name');
	}
	switch ( $column ) {
		case 'side' : echo (strtolower($left_or_right) == 'none' ? '' : $left_or_right);
		break;
		case 'workout' : echo implode(', ', $workout_list);
		break;
	}
}