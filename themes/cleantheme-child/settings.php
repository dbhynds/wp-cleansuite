<?php
/**
 * CleanThemeChild Theme Settings
 *
 * @package WordPress
 * @subpackage CleanThemeChild
 * @since CleanThemeChild 0.1
 */

class ct {
	var $content_width = 660;

	var $thumbnail = array( // Accepts false or array($args)
		'w' => 150, // Width of thumbnail
		'h' => 150, // Height of thumbnail
		'crop' => true // Crop thumbnail
	);

	var $logo = array( // Set logo parameters
		'width' => 150, // Width of logo
		'height' => 150, // Height of logo
		'flex-width' => true, // Flexible width?
	);

	var $menus = array( 'primary' => 'Main Menu' ); // Accepts false or array()

	var $sidebars = array();
		// Accepts false
		// string (i.e. 'sidebar')
		// or array_key with $args overriding the default i.e.
		// 'sidebar' => array('name'=>__('Sidebar %d'))

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

	var $editor_style = array(); // Accepts false, relative path (i.e 'css/styles.css'), or array() of paths
}

