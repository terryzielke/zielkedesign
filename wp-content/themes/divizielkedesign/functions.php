<?php
/*
  ENQUEUE STYLES & SCRIPTS
*/
add_action('wp_enqueue_scripts', function(){
	// CSS
    $css_file = get_template_directory() . '/css/theme.min.css';
    $version = file_exists($css_file) ? filemtime($css_file) : '1.0.0'; // fallback version
    wp_enqueue_style('theme.min', get_stylesheet_directory_uri() . '/css/theme.min.css', array(), $version);
	// JS
	wp_register_script('jquery', '/wp-includes/js/jquery/jquery.js', '', '', true);
	wp_enqueue_script('jquery');
	// custom
	wp_enqueue_script('zielkedesignjs', get_stylesheet_directory_uri().'/js/zielkedesign.js', ['jquery'], '', true);
	// plugin
	wp_enqueue_script( 'codrops-nearby', get_stylesheet_directory_uri() . '/inc/nearby/nearby.js');
	wp_enqueue_style( 'slick-css', get_stylesheet_directory_uri() . '/inc/slick/slick.css');
	wp_enqueue_script( 'slick-js', get_stylesheet_directory_uri() . '/inc/slick/slick.min.js', array(), '20151215', true );
});


/*
	LOAD SHORTCODES
*/
include get_stylesheet_directory() . '/php/shortcodes/zielkedesign-nearby.php';
include get_stylesheet_directory() . '/php/shortcodes/project-list.php';



/*
  CUSTOM LOGIN PAGE
*/

add_action( 'login_enqueue_scripts', function(){
	wp_enqueue_style( 'login_css', get_stylesheet_directory_uri() . '/css/login.css' );
});



/*
  CUSTOM ADMIN SCRIPTS
*/
add_action('admin_enqueue_scripts', function(){
	wp_enqueue_style('admin_css', get_stylesheet_directory_uri() . '/css/admin.css' );
});



/*
	REDIRECT FROM LOGOUT SCREEN TO HOME
*/
add_action('wp_logout', function(){
	wp_safe_redirect( home_url() );
	exit;
});


/*
	ALLOW SVGS
*/
add_filter('upload_mimes', function($mimes){
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
});