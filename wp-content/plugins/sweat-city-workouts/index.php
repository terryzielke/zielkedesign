<?php
/*
Plugin Name: Sweat City Workouts
Plugin URI: https://zielke.design
Description: Randomly generate a Sweat City workout.
Version: 1.0.1
Author: Terry Zielke
Author URI: http://zielke.design
License: GPL
Text Domain: sweatcity
*/


/* ABORT */
if ( ! defined( 'WPINC' ) ) {
	die;
}


/* Frontend scripts */
add_action( 'wp_enqueue_scripts', 'sc_workout_scripts' );
function sc_workout_scripts() {
	// CSS
	wp_enqueue_style( 'sc_workout_styles', plugins_url( '/scripts/styles.css', __FILE__ ) );
	// JS
	wp_enqueue_script( 'sc_workout_scripts', plugins_url( '/scripts/scripts.js', __FILE__ ), array('jquery') );
}


/* Hook to create the exercise post type */
add_action('init', 'create_exercise_post_type');
function create_exercise_post_type() {
    $labels = array(
        'name'               => 'Exercises',
        'singular_name'      => 'Exercise',
        'menu_name'          => 'Exercises',
        'name_admin_bar'     => 'Exercise',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New Exercise',
        'new_item'           => 'New Exercise',
        'edit_item'          => 'Edit Exercise',
        'view_item'          => 'View Exercise',
        'all_items'          => 'All Exercises',
        'search_items'       => 'Search Exercises',
        'not_found'          => 'No exercises found.',
        'not_found_in_trash' => 'No exercises found in Trash.',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'has_archive'        => true,
        'supports'           => array('title', 'editor', 'thumbnail'),
        'show_in_rest'       => true,  // Enables Gutenberg editor support
        'menu_icon'          => 'dashicons-heart',
    );

    register_post_type('exercise', $args);
}
// Include exercise post functions
include ('posts/edit-exercise.php');


/* Add custom capabilities to subscribers */
function add_custom_capabilities() {
    // Get all the roles in WordPress
    $roles = wp_roles()->roles;
    // Loop through each role and add the custom capabilities
    foreach ($roles as $role_name => $role_info) {
        $role = get_role($role_name);
        // Add the capability to manage terms for the taxonomy
        $role->add_cap('edit_equipment');
        $role->add_cap('assign_equipment');
    }
}
add_action('admin_init', 'add_custom_capabilities');


/* Equipment taxonomie */
function sc_equipment_taxonomy() {
    $labels = array(
        'name'              => _x( 'Equipment', 'taxonomy general name', 'sweatcity' ),
        'singular_name'     => _x( 'Equipment', 'taxonomy singular name', 'sweatcity' ),
        'search_items'      => __( 'Search equipment', 'sweatcity' ),
        'all_items'         => __( 'All equipment', 'sweatcity' ),
        'parent_item'       => __( 'Parent equipment', 'sweatcity' ),
        'parent_item_colon' => __( 'Parent equipment:', 'sweatcity' ),
        'edit_item'         => __( 'Edit equipment', 'sweatcity' ),
        'update_item'       => __( 'Update equipment', 'sweatcity' ),
        'add_new_item'      => __( 'Add New equipment', 'sweatcity' ),
        'new_item_name'     => __( 'New equipment Name', 'sweatcity' ),
        'menu_name'         => __( 'Equipment', 'sweatcity' ),
    );
    $args = array(
        'labels'            => $labels,
        'hierarchical'      => true,
        'public'            => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'equipment' ),
        'capabilities' 		=> array(
						            'manage_terms' => 'edit_equipment',
						            'edit_terms'   => 'edit_equipment',
						            'delete_terms' => 'edit_equipment',
						            'assign_terms' => 'assign_equipment',
						        ),
    );
    register_taxonomy( 'equipment', array( 'exercise', 'user' ), $args );
}
add_action( 'init', 'sc_equipment_taxonomy', 0 );


/* Workout taxonomie */
function sc_workout_taxonomy() {
    $labels = array(
        'name'              => _x( 'Workouts', 'taxonomy general name', 'sweatcity' ),
        'singular_name'     => _x( 'Workout', 'taxonomy singular name', 'sweatcity' ),
        'search_items'      => __( 'Search workout', 'sweatcity' ),
        'all_items'         => __( 'All workout', 'sweatcity' ),
        'parent_item'       => __( 'Parent workout', 'sweatcity' ),
        'parent_item_colon' => __( 'Parent workout:', 'sweatcity' ),
        'edit_item'         => __( 'Edit workout', 'sweatcity' ),
        'update_item'       => __( 'Update workout', 'sweatcity' ),
        'add_new_item'      => __( 'Add New workout', 'sweatcity' ),
        'new_item_name'     => __( 'New workout Name', 'sweatcity' ),
        'menu_name'         => __( 'Workouts', 'sweatcity' ),
    );
    $args = array(
        'labels'            => $labels,
        'hierarchical'      => true,
        'public'            => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'workout' ),
    );
    register_taxonomy( 'workout', array( 'exercise' ), $args );
}
add_action( 'init', 'sc_workout_taxonomy', 0 );


/* Hook to add the settings page under the Exercise menu */
add_action('admin_menu', 'exercise_manager_menu');
function exercise_manager_menu() {
    // Add submenu under the custom post type menu
    add_submenu_page(
        'edit.php?post_type=exercise',	// Parent slug
        'Block Settings',				// Page title
        'Block Settings',				// Submenu title
        'manage_options',               // Capability
        'block-settings',				// Menu slug
        'block_settings_page'			// Callback
    );
}
// callback function for settings
function block_settings_page() { include ('pages/options.php'); }


// custom user fields
require_once( plugin_dir_path( __FILE__ ) . 'users/user-taxonomies.php' );
// shortcode content
require_once( plugin_dir_path( __FILE__ ) . 'scripts/shortcodes.php' );
require_once( plugin_dir_path( __FILE__ ) . 'scripts/classes.php' );