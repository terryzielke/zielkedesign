<?php
/*
Plugin Name: Zielke Quick Slider
Plugin URI: https://zielke.design
Description: A gallery that quickly flips through images one at a time.
Version: 1.0.1
Author: Terry Zielke
Author URI: http://zielke.design
License: GPL
Text Domain: zielkedesign
*/


/* ABORT */
if ( ! defined( 'WPINC' ) ) {
	die;
}



/*
  Enqueue scripts and styles.
*/
add_action( 'wp_enqueue_scripts', 'quickslide_scripts' );
function quickslide_scripts() {
	// CSS
	wp_enqueue_style( 'quickcss', plugins_url('/assets/quickslide.css', __FILE__ ) );
	// JS
	wp_enqueue_script( 'quickjs', plugins_url('/assets/quickslide.js', __FILE__ ), array('jquery') );
}


/* Hook to create the post type */
add_action('init', 'quickslide_post_type');
function quickslide_post_type() {
    $labels = array(
        'name'               => 'Quick Slides',
        'singular_name'      => 'Quick Slide',
        'menu_name'          => 'Quick Slides',
        'name_admin_bar'     => 'Quick Slide',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New Quick Slide',
        'new_item'           => 'New Quick Slide',
        'edit_item'          => 'Edit Quick Slide',
        'view_item'          => 'View Quick Slide',
        'all_items'          => 'All Quick Slides',
        'search_items'       => 'Search Quick Slides',
        'not_found'          => 'No Quick Slides found.',
        'not_found_in_trash' => 'No Quick Slides found in Trash.',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'has_archive'        => true,
        'supports'           => array('title'),
        'show_in_rest'       => true,  // Enables Gutenberg editor support
        'menu_icon'          => 'dashicons-images-alt',
    );

    register_post_type('quickslide', $args);
}
// Include post functions
include ('posts/edit-quickslide.php');


// Include shortcode
include ('shortcodes/quickslide-shortcode.php');