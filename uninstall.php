<?php
// Fired when the plugin is uninstalled.
// If uninstall not called from WordPress, then exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

define('BASE_PATH', plugin_dir_path(__FILE__));

// include the Composer autoload file for our post_type
require BASE_PATH . 'vendor/autoload.php';

$post_type = \Neofonie\BusinessHours\SubPlugins\SimpleLocation::POST_TYPE;

$posts = new \WP_Query( ['post_type' => $post_type] );
if ( $posts->have_posts() ) {
    while ( $posts->have_posts() ) {
        $posts->the_post();
        wp_delete_post( get_the_ID());
    }
}   

// maybe we need it later, now we does not have some
//delete_option('neofonie_locations');

?>