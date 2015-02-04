# wp-cleansuite

WP Cleansuite is a suite of plugins and themes designed speed up the process of creating and deploying new WordPress sites.

## Table of Contents

*	Installation
*	Themes
	*	CleanTheme
	*	CleanTheme Child
*	Plugin

## Installation

Clone this repository into the /wp-content/ folder of your WordPress site.

Alternately, download a .zip of this repository and copy/paste the contents of the "plugins" and "themes" directories into their respective folders in /wp-content/.

## Themes

### CleanTheme

This is the base theme that includes commonly-used functions employed regardless of the theme. It is strongly advised to not modify this theme.

### CleanTheme Child

This theme is intended to be hacked apart and overwritten depending on the needs of the site. The settings.php file lets you define a variety of settings for your theme. **Edit this file first.** Use this file to define:

*	Default content width
*	Thumbnail image size
*	Logo size
*	Menus
*	Sidebars
*	Default sidebar settings
*	Post formats
*	Editor stylesheet

Also included is Tai's LESS framework. Compile 'less/styles.less' to 'css/styles.css'. **Do not include any CSS in the theme's 'style.css' file, as it will not be included on the front end.**

## Plugins

The following plugins are included by default:

*	Advanced Custom Fields
*	Advanced Custom Fields: Repeater Field
*	Contact Form 7
*	Google Analytics for WordPress
*	P3 (Plugin Performance Profiler)
*	WordPress Importer
*	WP Migrate DB