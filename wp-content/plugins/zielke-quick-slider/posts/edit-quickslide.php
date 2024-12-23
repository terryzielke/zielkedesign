<?php
	
/* Add metaboxs to post type */
add_action( 'add_meta_boxes', 'sc_quickslide_meta_boxs' );
function sc_quickslide_meta_boxs() {
	add_meta_box(
		'quickslide-images',	// box id
		'Images',				// box title
		'quickslide_images',	// box html
		'quickslide',			// post_types
		'normal'				// box location
	);
	add_meta_box(
		'quickslide-speed',
		'Speed (in milliseconds)',
		'quickslide_speed',
		'quickslide',
		'side'
	);
}
// callback functions
function quickslide_images( $post ) {
	include('metabox/images.php');
}
function quickslide_speed( $post ) {
	include('metabox/speed.php');
}


/* Save metadata */
add_action( 'save_post', 'sc_save_quickslide_meta_data' );
function sc_save_quickslide_meta_data( $post_id ){
	// Check for varified nonce
	if ( ! isset( $_POST['zielke_quickslide_nonce'] ) ||
		! wp_verify_nonce( $_POST['zielke_quickslide_nonce'], 'zielke_quickslide_nonce' ) ){
		return;
	}else{
		// post meta
		if ( isset($_REQUEST['quickslide_images']) ) {
	  		update_post_meta($post_id, 'quickslide_images', sanitize_text_field($_REQUEST['quickslide_images']) );
	    }
		if ( isset($_REQUEST['quickslide_speed']) ) {
	  		update_post_meta($post_id, 'quickslide_speed', sanitize_text_field($_REQUEST['quickslide_speed']) );
	    }
	}
}


/* CREATE CUSTOM COLOMNS */
add_filter( 'manage_edit-quickslide_columns', 'sc_add_quickslide_custom_columns' );
function sc_add_quickslide_custom_columns( $columns ){
	$columns = array(
		'cb'							=> '<input type="checkbox" />',
		'title'							=> __( 'Quickslide' ),
		'id'				  			=> __( 'Shortcode' )
	);
	return $columns;
}


/* ADD CUSTOM COLUMN DATA */
add_action( 'manage_quickslide_posts_custom_column' , 'sc_add_quickslide_custom_column_data', 10, 2 );
function sc_add_quickslide_custom_column_data( $column, $post_id ) {
	switch ( $column ) {
		case 'id' : echo '[quickslide id="'.$post_id.'"]';
		break;
	}
}