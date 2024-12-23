<?php
	// Renders the meta box on the post
	function zdmd_add_meta_boxes() {
		add_meta_box(
			'zdmd_desktop_mockup', // field id
			'Desktop Mockup', // field diplayed title
			'zdmd_desktop_mockup', // field content
			'mockup', // content type
			'normal' // field location
		);
		add_meta_box(
			'zdmd_light_dark',
			'Color',
			'zdmd_light_dark',
			'mockup',
			'side'
		);
	}
	add_action( 'add_meta_boxes', 'zdmd_add_meta_boxes' );
	
	
	// Content to display inside meta box
	function zdmd_desktop_mockup( $post ) {
		include( 'views/zdmd_desktop_mockup.php' );
	}
	function zdmd_light_dark( $post ) {
		include( 'views/zdmd_light_dark.php' );
	}
	
	// Save post meta data
	function zdmd_save_post_meta_data( $post_id ){
		// Check for varified nonce
		if ( ! isset( $_POST['zielke_design_mockup_display_nonce'] ) ||
			! wp_verify_nonce( $_POST['zielke_design_mockup_display_nonce'], 'zielke_design_mockup_display_nonce' ) ){
			return;
		}else{
			
			// desktop mockup
			if ( isset( $_REQUEST['desktop_mockup'] ) ) {
				update_post_meta( $post_id, 'desktop_mockup', sanitize_text_field($_REQUEST['desktop_mockup']) );
			}
			// light dark
			if ( isset( $_REQUEST['light_dark'] ) ) {
				update_post_meta( $post_id, 'light_dark', sanitize_text_field($_REQUEST['light_dark']) );
			}
			
		}
	}
	add_action( 'save_post', 'zdmd_save_post_meta_data' );


/* -----------------------------------------------------------------
	CREATE CUSTOM COLOMNS
----------------------------------------------------------------- */
add_filter( 'manage_edit-mockup_columns', 'zdmd_custom_columns' );
function zdmd_custom_columns( $columns ){
	$columns = array(
		'cb'								=> '<input type="checkbox" />',
		'title'							=> __( 'Client' ),
		'ID'	=> __( 'Shortcode' ),
		'date'							=> __( 'Date' )
	);
	return $columns;
}
// ADD CUSTOM COLUMN DATA
add_action( 'manage_mockup_posts_custom_column' , 'zdmd_custom_column_data', 10, 2 );
function zdmd_custom_column_data( $column, $post_id ) {
	switch ( $column ) {
		case 'ID' : echo '[zielke_mockup id="'.$post_id.'"]';
		break;
	}
}
/**/