<?php 

namespace Neofonie\BusinessHours\Admin\SubmenuPages\SimpleLocation;

use Neofonie\BusinessHours\SubPlugins\SimpleLocation;

class ShortcodeDescription {
   
    public function __construct() {   
    }

    public function init() {
		add_action('admin_menu', array($this, 'addShortcodeDescription')); 
    }
    
    public function addShortcodeDescription() {                
        add_submenu_page(
            'edit.php?post_type=' . SimpleLocation::POST_TYPE, // parent slug
            __('Shortcodes description','neofonie-business-hours'), // page title
            __('Shortcodes description','neofonie-business-hours'), // menu title
            'publish_posts', // capability
            'shortcodes', // menu slug            
            array($this, 'render') // function
        ); 
    }

    public function render($args) {
        include(BASE_PATH. 'src/TemplateParts/SimpleLocation-Shortcodes.php');  
    }

}