<?php
/**
 * CleanThemeChild Theme Settings
 *
 * @package WordPress
 * @subpackage CleanThemeChild
 * @since CleanThemeChild 0.1
 */

class ct_settings {
	var $content_width = 660;

	var $logo = array( // Set logo parameters
		'width' => 150, // Width of logo
		'height' => 150, // Height of logo
		'flex-width' => true, // Flexible width?
	);

	var $thumbnail = true; // Use post thumbnails

	var $image_sizes = array( // Accepts false or array( $name => $args )
		'thumbnail' => array(
			'w' => 150, // Width of thumbnail
			'h' => 150, // Height of thumbnail
			'crop' => true // Crop thumbnail (default: false)
		),
		'medium' => array(
			'w' => 330,
			'h' => 330,
		),
		'large' => array(
			'w' => 660,
			'h' => 660,
		),
	);

	var $menus = array( 'primary' => 'Main Menu' ); // Accepts false or array()

	var $sidebars = 'sidebar';
		// Accepts:
		// false
		// string, i.e. 'sidebar'
		// array of strings, i.e. array('sidebar1','sidebar2')
		// or array_key with $args overriding $sidebar_defaults, i.e. 'sidebar' => array('name'=>'Sidebar')

	var $sidebar_defaults = array(
		'name' => 'Widget Area',
	    'id' => 'sidebar',          
		'description' => '',
		'class'  => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h2 class="widgettitle">',
		'after_title' => '</h2>'
	);

	var $post_formats = array(); // Accepts false or array('format')

	var $editor_style = false; // Accepts false, relative path (i.e 'css/styles.css'), or array() of paths
}

