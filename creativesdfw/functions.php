<?php
/**
 * WP Bootstrap Starter Child Sitelook functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WP_Bootstrap_Starter_Sitelook
 */

/**
 * Enqueue scripts and styles.
 */
function creativesdfw_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'css-creativesdfw', get_stylesheet_directory_uri() . '/assets/css/basic-styles.css', array('wp-bootstrap-starter-bootstrap-css') );
}
add_action( 'wp_enqueue_scripts', 'creativesdfw_enqueue_styles' );

// load core functions
require_once get_stylesheet_directory() . '/core/load.php';