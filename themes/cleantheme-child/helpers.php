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
 * @since CleanThemeChild 0.2
 */

class ct extends ct_settings {

	public function __construct() {

		$this->sidebar_defaults['name'] = __($this->sidebar_defaults['name'],$this->ns);
		foreach ($this->menus as $key => $val) {
			$this->menus[$key] = __($val,$this->ns);
		}
		
		/**
		 * Set the content width based on the theme's design and stylesheet.
		 */
		if ( ! isset( $content_width ) ) {
			$content_width = $this->content_width;
		}

		add_action( 'after_setup_theme', array($this,'cleantheme_setup') );
		add_action( 'after_switch_theme', array($this,'ct_switch_theme') );
		add_action( 'widgets_init', array($this,'cleantheme_widgets_init') );


	}

	
	function cleantheme_setup() {

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		add_theme_support( 'custom-header', $this->logo );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * See: https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
		 */
		if ($this->thumbnail != false) {
			add_theme_support( 'post-thumbnails' );
			set_post_thumbnail_size(
					$this->thumbnail['w'],
					$this->thumbnail['h'],
					$this->thumbnail['crop']
				);
		}

		// This theme uses wp_nav_menu() in two locations.
		
		if ($this->menus != false) {
			register_nav_menus( $this->menus );
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
		if ($this->post_formats != false) {
			add_theme_support( 'post-formats', $this->post_formats );
		}

		/*
		 * This theme styles the visual editor to resemble the theme style,
		 * specifically font, colors, icons, and column width.
		 */
		if ($this->editor_style != false) {
			add_editor_style( $this->editor_style );
		}

	}

	function ct_switch_theme() {
		ct_image_sizes($this->image_sizes);
	}

	/**
	 * Register widget areas.
	 *
	 * @since CleanThemeChild 0.1
	 * @link https://codex.wordpress.org/Function_Reference/register_sidebar
	 */
	function cleantheme_widgets_init() {
		ct_register_sidebars($this->sidebars,$this->sidebar_defaults);
	}

}


