<?php 

namespace Neofonie\BusinessHours;

use Neofonie\BusinessHours\Plugin;
use Neofonie\BusinessHours\SubPlugins;
use Neofonie\BusinessHours\Shortcodes;
use Neofonie\BusinessHours\Widgets;
use Neofonie\BusinessHours\Admin\SubmenuPages\SimpleLocation\ShortcodeDescription;


/**
 * Instantiates all
 */
class BusinessHours {
    
    public function __construct() {
        //maybe we do staff before
        self::init();
    }

    protected static function init() {

        $plugin    = new Plugin();

        $plugin->addSubPlugin(new SubPlugins\SimpleLocation());
        $plugin->addShortcode(new Shortcodes\LocationListShortcode()); 
        $plugin->addSubmenuPage(new ShortcodeDescription());
        $plugin->addWidget(new Widgets\LocationWidget());
        if ( class_exists( 'FLBuilder' ) ) {
            $plugin->addModule('neo-businesshours');            
        }                      
        
        $plugin->init();       
    }   
        
}