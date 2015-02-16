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
 * Enqueue scripts and styles.
 *
 * @since CleanThemeChild 0.1
 */
function cleantheme_scripts() {

	// Load CleanThemeChild stylesheet
	// wp_enqueue_style( 'cleantheme-child', get_stylesheet_uri() );

	// Load CleanThemeChild 
	wp_enqueue_style( 'cleantheme-style', get_stylesheet_directory_uri() . '/css/styles.css');

	// Load the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'cleantheme-ie', get_stylesheet_directory_uri() . '/css/ie.css', array( 'cleantheme-style' ) );
	wp_style_add_data( 'cleantheme-ie', 'conditional', 'lt IE 9' );

	// Load CleanThemeChild scripts
	wp_enqueue_script( 'cleantheme-script', get_stylesheet_directory_uri() . '/js/functions.js', array( 'jquery' ), false, true );
	//wp_localize_script();
}
add_action( 'wp_enqueue_scripts', 'cleantheme_scripts' );



/**
 * Get default settings.
 *
 * @since CleanThemeChild 0.1
 */
require 'settings.php';
$ct = new ct();

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = $ct->content_width;
}

if ( ! function_exists( 'cleantheme_setup' ) ) :
function cleantheme_setup() {
	global $ct;

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	add_theme_support( 'custom-header', $ct->logo );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * See: https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	if ($ct->thumbnail != false) {
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size(
				$ct->thumbnail['w'],
				$ct->thumbnail['h'],
				$ct->thumbnail['crop']
			);
	}

	// This theme uses wp_nav_menu() in two locations.
	
	if ($ct->menus != false) {
		register_nav_menus( $ct->menus );
	}

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	if ($ct->post_formats != false) {
		add_theme_support( 'post-formats', $ct->post_formats );
	}

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	if ($ct->editor_style != false) {
		add_editor_style( $ct->editor_style );
	}

}
endif; // twentyfifteen_setup
add_action( 'after_setup_theme', 'cleantheme_setup' );

function ct_switch_theme() {
	global $ct;
	ct_image_sizes($ct->image_sizes);
}
add_action( 'after_switch_theme', 'ct_switch_theme' );

/**
 * Register widget areas.
 *
 * @since CleanThemeChild 0.1
 * @link https://codex.wordpress.org/Function_Reference/register_sidebar
 */
function cleantheme_widgets_init() {
	global $ct;
	ct_register_sidebars($ct->sidebars);
}
add_action( 'widgets_init', 'cleantheme_widgets_init' );


