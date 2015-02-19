<?php
/**
 * CleanTheme functions and definitions
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
 * @subpackage CleanTheme
 * @since CleanTheme 0.1
 */


if ( ! function_exists( 'ct_get_the_thumbnail' ) ) :
function ct_get_the_thumbnail() {
	/**
	 * Arguments follow get_the_post_thumbnail( $post_id, $size, $attr );
	 * http://codex.wordpress.org/Function_Reference/get_the_post_thumbnail
	 *
	 * One additional argument is $showlink (bool) which, if set will override the default is_single()
	 * get_the_post_thumbnail( $post_id, $size, $attr, $link );
	 */

	$funcargs = func_get_args();

	$post_id = (isset($funcargs[0])) ? $funcargs[0] : get_the_id();
	$size = (isset($funcargs[1])) ? $funcargs[1] : 'post-thumbnail';
	$attr = (isset($funcargs[2])) ? $funcargs[2] : null;

	$link = (isset($link)) ? $link : (is_search() || is_archive() || is_home());


	if (has_post_thumbnail($post_id)) {
		$return = '';
		if ($link) {
			$return .= '<a href="'.get_permalink($post_id).'">';
		}

		$return .= get_the_post_thumbnail($post_id,$size,$attr);
		
		if ($link) {
			$return .= '</a>';
		}

		return $return;
	}
}
endif;

if ( ! function_exists( 'ct_the_thumbnail' ) ) :
function ct_the_thumbnail() {
	$args = func_get_args();
	
	$size = (isset($args[0])) ? $args[0] : null;
	$attr = (isset($args[1])) ? $args[1] : null;

	// Echo ct_get_the_thumbnail()
	echo ct_get_the_thumbnail(get_the_id(),$size,$attr);
}
endif;


if ( ! function_exists( 'ct_get_header_image' ) ) :
function ct_get_header_image() {
	// Return the logo inside a link with alt, height and width attributes
	$return = '';
	$return .= '<a href="'.home_url().'" rel="home">';
	$return .= '<img src="'.header_image().'" alt="'.get_bloginfo('name').'" height="'.get_custom_header()->height.'" width="'.get_custom_header()->width.'">';
	$return .= '</a>';
	return $return;
}
endif;
if ( ! function_exists( 'ct_the_header_image' ) ) :
function ct_the_header_image() {
	// Echo ct_get_header_image()
	echo ct_get_header_image($args);
}
endif;


if ( ! function_exists( 'ct_get_link' ) ) :
function ct_get_link() {
	/**
	 * Returns a link with some internal content
	 *
	 * USAGE
	 * $link = ct_get_link( $content, $id );
	 *
	 * PARAMETERS
	 * $content (required) The content (text or HTML) to be displayed inside the link.
	 * $id (optional) The integer ID for a post or page, or a post object. Default: The current post ID
	 */

	$args = func_get_args();
	if (!isset($args[0])) {
		return false;
	}

	$args[1] = (isset($args[1])) ? $args[1] : null;
	$return = '<a href="'.get_permalink($args[1]).'">'.$args[0].'</a>';
	return $return;
}
endif;
if ( ! function_exists( 'ct_the_link' ) ) :
function ct_the_link() {
	// Echo ct_get_link()
	$args = func_get_args();
	echo ct_get_link($args);
}
endif;


if ( ! function_exists( 'ct_get_field' ) ) :
function ct_get_field() {
	// Return an empty array() instead of false if the field is empty, so that foreach() loops don't break
	if (function_exists('get_field')) {
		$args = func_get_args();
		$field_name = ($args[0]);
		$post_id = ($args[1]) ? $args[1] : null;
		$format_value = ($args[2]) ? $args[2] : null;
		$results = get_field($field_name, $post_id, $format_value);
		if ($results === false) {
			return array();
		} else {
			return $results;
		}
	} else {
		return false;
	}
}
endif;

/**
 * Register widget areas.
 *
 * @since CleanThemeChild 0.2
 * @link https://codex.wordpress.org/Function_Reference/register_sidebar
 */
if ( ! function_exists( 'ct_register_sidebars' ) ) :
function ct_register_sidebars($sidebars,$defaults) {
	if ( $sidebars != false ) {
		if (is_array($sidebars)) {
			foreach ($sidebars as $handle => $overrideargs) {
				// Set default $args
				$args = $defaults;
				// Override any specified defaults
				if (is_array($overrideargs)){
					$args['id'] = $handle;
					foreach ($overrideargs as $key => $value) {
						$args[$key] = $value;
					}
				} else { // Or just override the ID
					$args['id'] = $overrideargs;
				}
				// Register that sucker!
				register_sidebar( $args );
			}
		} else {
			$args = $defaults;
			$args['id'] = $sidebars;
			register_sidebar( $args );
		}
	}
}
endif;

/**
 * Setup image sizes.
 *
 * @since CleanThemeChild 0.2
 * @link https://codex.wordpress.org/Function_Reference/add_image_size
 */
if ( ! function_exists('ct_image_sizes') ) :
function ct_image_sizes($image_sizes) {
	foreach ($image_sizes as $name => $args) {
		if ( get_option($name.'_size_w') ||
			get_option($name.'_size_h') ||
			get_option($name.'_crop') ) {
				update_option($name.'_size_w',$args['w']);
				update_option($name.'_size_h',$args['h']);
				if (array_key_exists('crop', $args)) {
					update_option($name.'_crop',$args['crop']);
				}
		} else {
			if (array_key_exists('crop', $args)) {
				add_image_size($name,$args['w'],$args['h'],$args['crop']);
			} else {
				add_image_size($name,$args['w'],$args['h']);
			}
		}
	}
}
endif;



