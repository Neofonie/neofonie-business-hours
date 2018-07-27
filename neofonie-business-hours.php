<?php
/**
 * Plugin Name: Neofonie - Business Hours 
 * Description: Add fields for business hours for locations, displays them on location site, has a widget which lists all locations and some shortcodes.
 * Version: 0.1.0
 * Author: neofonie GmbH: Jennifer Weniger
 */

// If this file is accessed directory, then abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

define('BASE_PATH', plugin_dir_path(__FILE__));
define('BASE_URL', plugin_dir_url(__FILE__));

// include the Composer autoload file
require BASE_PATH . 'vendor/autoload.php';



new Neofonie\BusinessHours\BusinessHours;