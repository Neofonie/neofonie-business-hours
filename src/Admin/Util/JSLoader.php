<?php

namespace Neofonie\BusinessHours\Admin\Util;

/**
 * Provides a consistent way to enqueue all javascript files.
 *
 * The first is responsible for hooking up the enqueue
 * callback to the proper WordPress hook. The second is responsible for
 * actually registering and enqueuing the file.
 *
 * @implements AssetsInterface
 * @since      0.2.0
 */
class JSLoader implements AssetsInterface {
 
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
        wp_enqueue_script('jquery-ui-datepicker');    
        wp_register_script( 
            'jquery-ui-multi-datepicker',
            BASE_URL . 'assets/js/admin/jquery-ui.multidatespicker.js',
            array('jquery', 'jquery-ui-datepicker'),
            filemtime( BASE_PATH . 'assets/js/admin/jquery-ui.multidatespicker.js' )
        );
        wp_register_script(
            'neo-businesshours',
            BASE_URL . 'assets/js/admin/admin.js',
            array('jquery-ui-multi-datepicker' ),
            filemtime( BASE_PATH . 'assets/js/admin/admin.js' )
        );
        wp_enqueue_script( 'jquery-ui-multi-datepicker');
        wp_enqueue_script( 'neo-businesshours');
 
    }

    public function enqueueFrontendScripts() {        
        // wp_enqueue_script(
        //     'neo-businesshours',
        //     BASE_URL . 'assets/js/bundle.js',
        //     array(),
        //     filemtime( BASE_PATH . 'assets/js/bundle.js' )
        // );
    }
}