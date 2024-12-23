<?php
/*
Plugin Name: Zielke Design Mockup Display
Plugin URI: http://zielke.design/
Description: Create scrollable mockups inside monitor graphics that can be added to pages via shortcode.
Version: 1.0.0
Author: Terry Zielke
Author URI: http://zielke.design
License: GPLv2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: zielkedesign
*/

/*
	ABORT
	
	If this file is called directly, abort.
*/
if ( ! defined( 'WPINC' ) ) { die; }

/*
	ACTIVATION
	
	Runs when plugin is activated.
*/
function zdmd_activate_plugin() {
	// Do Nothing
}
register_activation_hook(__FILE__,'zdmd_activate_plugin'); 

/*
	DEACTIVATE
	
	Runs when plugin is deactivated.
*/
function zdmd_deactivate_plugin() {
	// Do Nothing
}
register_deactivation_hook( __FILE__, 'zdmd_deactivate_plugin' );

function zdmd_uninstall_plugin(){
	// Do Nothing
}
register_uninstall_hook(__FILE__, 'zdmd_uninstall_plugin');



/*
	CONENT TYPE
	
	Register a custom conent type called "mockup",
	and apply labels.
*/
function zdmd_mockup_post_int() {
	$labels = array(
		'name'                  => _x( 'Mockups', 'Post type general name', 'zielkeDesign' ),
		'singular_name'         => _x( 'Mockup', 'Post type singular name', 'zielkeDesign' ),
		'menu_name'             => _x( 'Mockups', 'Admin Menu text', 'zielkeDesign' ),
		'name_admin_bar'        => _x( 'Mockup', 'Add New on Toolbar', 'zielkeDesign' ),
		'add_new'               => __( 'Add New', 'zielkeDesign' ),
		'add_new_item'          => __( 'Add New Mockup', 'zielkeDesign' ),
		'new_item'              => __( 'New Mockup', 'zielkeDesign' ),
		'edit_item'             => __( 'Edit Mockup', 'zielkeDesign' ),
		'view_item'             => __( 'View Mockup', 'zielkeDesign' ),
		'all_items'             => __( 'All Mockups', 'zielkeDesign' ),
		'search_items'          => __( 'Search Mockups', 'zielkeDesign' ),
		'parent_item_colon'     => __( 'Parent mockup:', 'zielkeDesign' ),
		'not_found'             => __( 'No Mockups found.', 'zielkeDesign' ),
		'not_found_in_trash'    => __( 'No Mockups found in Trash.', 'zielkeDesign' ),
		'featured_image'        => _x( 'Mockup Thumbnail', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'zielkeDesign' ),
		'set_featured_image'    => _x( 'Set thumbnail', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'zielkeDesign' ),
		'remove_featured_image' => _x( 'Remove thumbnail', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'zielkeDesign' ),
		'use_featured_image'    => _x( 'Use as thumbnail', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'zielkeDesign' ),
		'archives'              => _x( 'Mockup archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'zielkeDesign' ),
		'insert_into_item'      => _x( 'Insert into mockup', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'zielkeDesign' ),
		'uploaded_to_this_item' => _x( 'Uploaded to this mockup', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'zielkeDesign' ),
		'filter_items_list'     => _x( 'Filter mockup list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'zielkeDesign' ),
		'items_list_navigation' => _x( 'Mockup list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'zielkeDesign' ),
		'items_list'            => _x( 'Mockup list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'zielkeDesign' ),
	);
 
	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => false,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'mockup' ),
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => false,
		'menu_position'      => 1,
		'taxonomies'				 => array('post_tag', 'project_group'),
		'supports'           => array( 'title', 'thumbnail' ),
	);
 
	register_post_type( 'mockup', $args );
	
}
add_action( 'init', 'zdmd_mockup_post_int' );


/*
	DASHBOARD PAGES
	
	Register dashboard pages for displaying
	a list of created galleries, and for
	settings that control how the galleries
	will appear.
*/
function zdmd_register_dashboard_pages(){
	add_menu_page( 
		'Mockup', // page title
		'Mockup', // menu title
		'edit_posts', // capabilities
		'zdmd', // page slug
		'display_zdmd_main_page', // page content call
		'dashicons-desktop',
		11
	);

  $submenu_pages = array(
		# Avoid duplicate pages. Add submenu page with same slug as parent slug.
		array(
			'parent_slug' => 'zdmd',
			'page_title'  => 'Mockup Summary',
			'menu_title'  => 'Summary',
			'capability'  => 'edit_posts',
			'menu_slug'   => 'zdmd',
			'function'    => 'display_zdmd_main_page',// Uses the same callback function as parent menu.
		),
		# Post Type :: View All Posts
		array(
			'parent_slug' => 'zdmd',
			'page_title'  => '',
			'menu_title'  => 'Mockups',
			'capability'  => 'edit_posts',
			'menu_slug'   => 'edit.php?post_type=mockup',
			'function'    => null,// Doesn't need a callback function.
		),
		# Post Type :: Add New Post
		array(
			'parent_slug' => 'zdmd',
			'page_title'  => '',
			'menu_title'  => 'Add New',
			'capability'  => 'edit_posts',
			'menu_slug'   => 'post-new.php?post_type=mockup',
			'function'    => null,// Doesn't need a callback function.
		),
		# Taxonomy :: Manage Options
		array(
			'parent_slug' => 'zdmd',
			'page_title'  => 'Options',
			'menu_title'  => 'Options',
			'capability'  => 'edit_posts',
			'menu_slug'   => 'zdmd-options',
			'function'    => 'display_zdmd_options_page',
		),
		
  );
  # Add each submenu item to custom admin menu.
  foreach ( $submenu_pages as $submenu ) {

      add_submenu_page(
          $submenu['parent_slug'],
          $submenu['page_title'],
          $submenu['menu_title'],
          $submenu['capability'],
          $submenu['menu_slug'],
          $submenu['function']
      );

  }
}
add_action( 'admin_menu', 'zdmd_register_dashboard_pages' );

function display_zdmd_main_page(){
    include('admin/pages/main.php'); 
}
function display_zdmd_options_page(){
    include('admin/pages/settings.php'); 
}


/*
	CORRECT MENU HIGHLIGHTING
*/
if ( ! function_exists( 'zdmd_set_current_menu' ) ) {

    function zdmd_set_current_menu( $parent_file ) {
        global $submenu_file, $current_screen, $pagenow;
        # Set the submenu as active/current while anywhere in your Custom Post Type (nwcm_news)
        if ( $current_screen->post_type == 'mockup' ) {

            if ( $pagenow == 'post.php' ) {
                $submenu_file = 'edit.php?post_type=' . $current_screen->post_type;
            }

            if ( $pagenow == 'edit-tags.php' ) {
                $submenu_file = 'edit-tags.php?taxonomy=project_group&post_type=' . $current_screen->post_type;
            }
            $parent_file = 'zdmd';
        }
        return $parent_file;
    }
    add_filter( 'parent_file', 'zdmd_set_current_menu' );
}

/*
	SHORTCODE
*/
require_once( plugin_dir_path( __FILE__ ) . 'shortcodes/display_mockups.php' );

/*
	ENGUEUE SCRIPTS
	
	Frontend CSS and JS scripts for single
	and grid galleries.
*/
function zdmd_frontend_scripts() {
	// CSS
	wp_enqueue_style( 'zdmd_frontend_styles',	plugin_dir_url( __FILE__ ) . 'css/zdmd_frontend.css');
   // JS
	wp_enqueue_script( 'zdmd_frontend_scripts',	plugin_dir_url( __FILE__ ) . 'js/zdmd_frontend.js', array( 'jquery' ));
}
add_action( 'wp_enqueue_scripts', 'zdmd_frontend_scripts' );
/*
	Backend CSS and JS scripts
*/
function zdmd_backend_scripts() {
	// CSS
	wp_enqueue_style( 'zdmd_backend_styles', plugin_dir_url( __FILE__ ) . 'css/zdmd_backend.css');
	wp_enqueue_style( 'fontawesome', 'https://use.fontawesome.com/releases/v5.0.13/css/all.css');
	// JS
	wp_enqueue_script( 'zdmd_backend_scripts', plugin_dir_url( __FILE__ ) . 'js/zdmd_backend.js', array( 'jquery' ));
	wp_enqueue_script( 'zdmd_media_scripts', plugin_dir_url( __FILE__ ) . 'js/zdmd_media.js', array( 'jquery' ));
}
add_action( 'admin_enqueue_scripts', 'zdmd_backend_scripts' );


/* -----------------------------------------------------------------
	EDIT POST FUNCTIONS
----------------------------------------------------------------- */
require_once( plugin_dir_path( __FILE__ ) . 'admin/zdmd_edit_mockups.php' );
