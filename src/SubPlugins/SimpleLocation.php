<?php

namespace Neofonie\BusinessHours\SubPlugins;

use Neofonie\BusinessHours\Admin\MetaBoxes\SimpleLocation\MetaBox;
use Neofonie\BusinessHours\Admin\MetaBoxes\SimpleLocation\MetaBoxDisplay;
use Neofonie\BusinessHours\Admin\Domain\Repository\SimpleLocationRepository;
use Neofonie\BusinessHours\Admin\Domain\Model\TradingHourDays;
use Neofonie\BusinessHours\Views\MetaContent;



class SimpleLocation {

    const POST_TYPE = 'neofonie_locations';
    const LOCATION_HOUR_DAY_FILTER_TYPE = 'neofonie_location_trading_hours_days';

    // Hooks, which could others use
    const BEFORE_FORM_HOOK = 'neofonie_location_admin_form_start';
    const AFTER_FORM_HOOK = 'neofonie_location_admin_form_end';
    const AFTER_SAVING_HOOK = 'neofonie_location_admin_save';
    const BEFORE_META_DATA_CONTENT_OUTPUT_HOOK = 'neofonie_location_meta_data_output_start';
    const AFTER_META_DATA_CONTENT_OUTPUT_HOOK = 'neofonie_location_meta_data_output_end';
    const BEFORE_MAIN_CONTENT_OUTPUT_HOOK ='neofonie_location_before_main_content';
    const AFTER_MAIN_CONTENT_OUTPUT_HOOK ='neofonie_location_meta_data_output_end';

    
    /**     
     * @var array
     */
    private $locationTradingHourDays = array();

    /**
     * @var \Neofonie\BusinessHours\Admin\MetaBoxes\SimpleLocation\MetaBox
     */
    private $metaBox;

    /**
     * @var \Neofonie\BusinessHours\Views\MetaContent
     */
    private $metaContent;
    
    /**
     * @var \Neofonie\BusinessHours\Admin\Domain\Repository\SimpleLocationRepository
     */
    private $locationRepository;   


    public function __construct() {      
        add_action('init', array($this, 'registerNewContentType'));        
        $this->setLocationTradingHourDays();  
        $this->metaBox = new MetaBox(
            new MetaBoxDisplay( $this->locationTradingHourDays ) 
        ); 
        $this->metaContent = new MetaContent();
        $this->locationRepository = new SimpleLocationRepository();        
        
        register_activation_hook(__FILE__, array($this,'pluginActivate')); //activate hook
        register_deactivation_hook(__FILE__, array($this,'pluginDeactivate')); //deactivate hook 
        
        add_filter('single_template', array($this, 'addTemplate'));        
    }

    public function init() {            
        $this->metaBox->init();
        $this->metaContent->init();        
    }

    //set the default days to use for the trading hours
    public function setLocationTradingHourDays() {                  
        // with the filter a theme or another plugin could redefine the days that locations are open for business    
        $this->locationTradingHourDays = apply_filters(
            SimpleLocation::LOCATION_HOUR_DAY_FILTER_TYPE,
            TradingHourDays::DAYS
        );         
    }

    //register the location content type
    public function registerNewContentType() {  
        //Labels for post type
        $labels = array(
            'name'               => __('Location','neofonie-business-hours'),
            'singular_name'      => __('Location','neofonie-business-hours'),
            'menu_name'          => __('Locations','neofonie-business-hours'),
            'name_admin_bar'     => __('Location','neofonie-business-hours'),
            'add_new'            => __('Add New','neofonie-business-hours'),
            'add_new_item'       => __('Add New Location','neofonie-business-hours'),
            'new_item'           => __('New Location','neofonie-business-hours'),
            'edit_item'          => __('Edit Location','neofonie-business-hours'),
            'view_item'          => __('View Location','neofonie-business-hours'),
            'all_items'          => __('All Locations','neofonie-business-hours'),
            'search_items'       => __('Search Locations','neofonie-business-hours'),
            'parent_item_colon'  => __('Parent Location:','neofonie-business-hours'),
            'not_found'          => __('No Locations found.','neofonie-business-hours'),
            'not_found_in_trash' => __('No Locations found in Trash.','neofonie-business-hours'),
        );   
        //arguments for post type
        $args = array(
            'labels'            => $labels,
            'public'            => true,
            'publicly_queryable'=> true,
            'show_ui'           => true,
            'show_in_nav'       => true,            
            'query_var'         => true,
            'hierarchical'      => false,
            'supports'          => array('title'),
            'has_archive'       => true,
            'menu_position'     => 20,
            'show_in_admin_bar' => true,
            'menu_icon'         => 'dashicons-location-alt',
            'rewrite'            => array('slug' => 'locations', 'with_front' => 'true')            
        );
        //register post type
        register_post_type(SimpleLocation::POST_TYPE, $args);        
    }

    

    //triggered on activation of the plugin (called only once)
    public function pluginActivate(){  
        //call our custom content type function
        $this->registerNewContentType();  
        //flush permalinks
        flush_rewrite_rules();
    }
    
    //trigered on deactivation of the plugin (called only once)
    public function pluginDeactivate(){
        //flush permalinks
        flush_rewrite_rules();
    }

    public function addTemplate($template) {
        global $post;

        /* Checks for single template by post type */
        if ( $post->post_type == SimpleLocation::POST_TYPE ) {
            
            // A specific single template for my custom post type exists in theme folder? Or it also doesn't exist in my plugin?
            if($template === get_stylesheet_directory() . '/single-neofonie_locations.php' || !file_exists(BASE_PATH . 'src/Views/NeofonieLocations.php')) {
                //Then return "single.php" or "single-my-custom-post-type.php" from theme directory.
                return $template;
            }

            // If not, return my plugin custom post type template.
            return BASE_PATH . 'src/Views/NeofonieLocations.php';            
        }

        //This is not my custom post type, do nothing with $template
        return $template;
    }
            
}