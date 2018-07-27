<?php 

namespace Neofonie\BusinessHours;

use Neofonie\BusinessHours\Admin\Util\CSSLoader;
use Neofonie\BusinessHours\Admin\Util\JSLoader;

/**
 * This is the class for this plugin.
 */

class Plugin {
    private $shortcodes;
    private $widgets;  
    private $subPlugins; 
    private $modules;   
    private $submenu;        

    /**
     * @var \Neofonie\BusinessHours\Admin\Util\CSSLoader
     */
    private $cssLoader; 

    /**
     * @var \Neofonie\BusinessHours\Admin\Util\JSLoader
     */
    private $jsLoader; 

    public function __construct() {
        $this->subPlugins = array();
        $this->shortcodes = array();
        $this->widgets = array();
        $this->modules = array();
        $this->submenu = array();
        $this->cssLoader = new CSSLoader();
        $this->jsLoader = new JSLoader();        
    }

    public function init() {      
        $this->registerSubPlugins();          
        $this->registerShortcodes();
        $this->registerWidgets();
        $this->registerModules();
        $this->registerSubmenu();
        $this->cssLoader->init();
        $this->jsLoader->init();            
    }

    public function addSubPlugin($subPlugin) {
        array_push($this->subPlugins, $subPlugin);

    }

    public function addShortcode($shortcode) {
        array_push($this->shortcodes, $shortcode);

    }

    public function addWidget($widget) {
        array_push($this->widgets, $widget);
    }

    public function addModule($module) {
        array_push($this->modules, $module);
    }

    public function addSubmenuPage($page) {
        array_push($this->submenu, $page);
    }

    private function registerSubPlugins() {
        if (count($this->subPlugins)) {
            foreach ($this->subPlugins as $subPlugin) {
                $subPlugin->init();
            }
        }
    }

    private function registerShortcodes() {
        if (count($this->shortcodes)) {
            foreach ($this->shortcodes as $shortcode) {
                $shortcode->init();
            }
        }
    }

    private function registerWidgets() {
        if (count($this->widgets)) {
            foreach ($this->widgets as $widget) {
                $widget->init();
            }
        }
    }

    private function registerModules() {
        if (count($this->modules)) {
            add_action( 'plugins_loaded', array($this, 'setupHooks') );
        }
    }

    private function registerSubmenu() {
        if (count($this->submenu)) {
            foreach ($this->submenu as $page) {
                $page->init();
            }
        }
    }

    /**
	 * Setup hooks after plugins loaded
	 */
	public function setupHooks() {   
        $this->loadTranslations();
        
        // if the builder is installed and activated load custom modules
		if ( ! class_exists( 'FLBuilder' ) ) {
			return;	
		}				
        add_action( 'init', array($this, 'loadModules'));            
    }
    
    /**
	 * Loads our custom modules.
	 */
	public function loadModules() {
        foreach ($this->modules as $module) {
            require_once BASE_PATH . 'src/modules/'. $module. '/'. $module . '.php';                
        }		
    }
    
    public function loadTranslations(){               
        $domain = 'neofonie-business-hours';
      //  $locale = apply_filters( 'plugin_locale', get_locale(), $domain );                        
        load_plugin_textdomain( $domain, FALSE, $domain . '/languages/');                              
    }
}