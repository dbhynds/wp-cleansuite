<?php
/**
 * CleanThemeChild functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package WordPress
 * @subpackage CleanThemeChild
 * @since CleanThemeChild 0.1
 */



/**
 * Get default settings.
 *
 * @since CleanThemeChild 0.1
 */
require 'settings.php';
require 'helpers.php';
$ct = new ct();

/**
 * Enqueue scripts and styles.
 *
 * @since CleanThemeChild 0.1
 */
function cleantheme_scripts() {
	global $ct;

	// Load CleanThemeChild stylesheet
	// wp_enqueue_style( 'cleantheme-child', get_stylesheet_uri() );

	// Load CleanThemeChild 
	wp_enqueue_style( $ct->ns.'-style', get_stylesheet_directory_uri() . '/css/styles.css');

	// Load the Internet Explorer specific stylesheet.
	wp_enqueue_style( $ct->ns.'-ie', get_stylesheet_directory_uri() . '/css/ie.css', array( $ct->ns.'-style' ) );
	wp_style_add_data( $ct->ns.'-ie', 'conditional', 'lt IE 9' );

	// Load CleanThemeChild scripts
	wp_enqueue_script( $ct->ns.'-script', get_stylesheet_directory_uri() . '/js/functions.js', array( 'jquery' ), false, true );
	//wp_localize_script();
}
add_action( 'wp_enqueue_scripts', 'cleantheme_scripts' );

function cleantheme_init() {
	global $ct;
}
add_action( 'init', 'cleantheme_init' );





