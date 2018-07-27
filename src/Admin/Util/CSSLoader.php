<?php

namespace Neofonie\BusinessHours\Admin\Util;

/**
 * Provides a consistent way to enqueue all stylesheets.
 *
 * The first is responsible for hooking up the enqueue
 * callback to the proper WordPress hook. The second is responsible for
 * actually registering and enqueuing the file.
 *
 * @implements AssetsInterface
 * @since      0.2.0
 */
class CSSLoader implements AssetsInterface {
 
    /**
     * Registers the 'enqueue' function with the proper WordPress hook for
     * registering stylesheets.
     */
    public function init() {
 
        add_action(
            'admin_enqueue_scripts',
            array( $this, 'enqueueAdminScripts' )
        );

        add_action(
            'wp_enqueue_scripts',
            array( $this, 'enqueueFrontendScripts' )
        );
 
    }
 
    
    public function enqueueAdminScripts() {
        wp_enqueue_style('jquery-ui-css', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css');
        wp_enqueue_style('jquery-ui-multi-datepicker',
            BASE_URL . 'assets/css/admin/jquery-ui.multidatespicker.css',
            array(),
            filemtime( BASE_PATH . 'assets/css/admin/jquery-ui.multidatespicker.css' )
        );
        // add admin.css on every page!
        wp_enqueue_style(
            'neo-businesshours',
            BASE_URL . 'assets/css/admin/admin.css',
            array(),
            filemtime( BASE_PATH . 'assets/css/admin/admin.css' )
        );
 
    }

    public function enqueueFrontendScripts() {        
        wp_enqueue_style(
            'neo-businesshours',
            BASE_URL . 'assets/css/styles.css',
            array(),
            filemtime( BASE_PATH . 'assets/css/styles.css' )
        );
    }
}