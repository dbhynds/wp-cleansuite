<?php
/*
Plugin Name: Disable Auto Updates
Description: Disable WordPress automatic background updates
Author: dbhynds
Version: 1.0.0
Author URI: http://www.mightybytes.com/
Text Domain: disable-auto-updates
*/

if (!defined('ABSPATH'))die('Forbidden');
add_filter('automatic_updater_disabled','__return_true');