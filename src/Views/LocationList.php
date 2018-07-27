<?php 
namespace Neofonie\BusinessHours\Views;

use Neofonie\BusinessHours\Admin\Domain\Model\SimpleLocation;
use Neofonie\BusinessHours\Admin\Domain\Model\TradingHourDays;

class LocationList {

    const DEFAULT_VALUES = [        
        'location_id'   => '',        
        'number_of_locations'   => -1,
        'use_compact_list' => false,
        'use_horizontal_list' => false,
        'name' => '',
        'orderby' => 'ID',
        'order' => 'ASC'
    ];

    private $values;

    public function __construct() {    
        $this->values = LocationList::DEFAULT_VALUES;
    }

    public function render($args = "") {
       $locations = $this->getLocations($args);       
       if($locations) {           
            ob_start(); // turn on output buffering            
            if($this->values['use_compact_list'] ) {
                include(BASE_PATH. 'src/TemplateParts/SimpleLocation-LocationListCompact.php');                                                 
            } else {
                include(BASE_PATH. 'src/TemplateParts/SimpleLocation-LocationList.php');                                 
            }
            $html = ob_get_contents(); // get the contents of the output buffer
            ob_end_clean();        
            return $html;  
       } 
       return '';
    }

    private function getLocations($args = "") {        
        //update default args if we passed in new args
        if(!empty($args) && is_array($args)){
            //go through each supplied argument
            foreach($args as $arg_key => $arg_val){                
                //if this argument exists in our default argument, update its value
                if(array_key_exists($arg_key, LocationList::DEFAULT_VALUES)){
                    $this->values[$arg_key] = $arg_val;
                }
            }
        }        

        $locations = array();
        //get a specific location by post_title (used by shortcode)
        if(!empty($this->values['name'])) {            
            $locations[] = get_page_by_title($this->values['name'], OBJECT, \Neofonie\BusinessHours\SubPlugins\SimpleLocation::POST_TYPE);            
        } //find locations 
        else {
            $location_args = array(
                'post_type'     => \Neofonie\BusinessHours\SubPlugins\SimpleLocation::POST_TYPE,
                'posts_per_page'=> $this->values['number_of_locations'] === 'default' ? -1: $this->values['number_of_locations'],
                'post_status'   => 'publish',                
                'orderby' => $this->values['orderby'],
                'order' => $this->values['order']                
            );    
            //if we passed in a single location to display
            if(!empty($this->values['location_id']) && $this->values['location_id']!=='default'){
                $location_args['include'] = $this->values['location_id'];
            }   
            $locations = get_posts($location_args);                        
        }           
        // prepare for template
        if($locations) {
            $tmpLocations = array();
            //foreach location collect data
            foreach($locations as $location) { 
                $simpleLocation = new SimpleLocation();
                $simpleLocation->loadByPostID($location->ID);
                $tradingHourDays = new TradingHourDays();
                $tradingHourDays->loadByPostID($location->ID);
                $tmp = [
                    'id' => $location->ID,
                    'title' => get_the_title($location->ID),
                 /*   'thumbnail' => get_the_post_thumbnail($location->ID,'thumbnail'),
                    'content' => apply_filters('the_content', $location->post_content),
                    'permaLink' => get_permalink($location->ID), */
                    'simpleLocation' => $simpleLocation,
                    'tradingHourDays' => $tradingHourDays                    
                ];                               
                if(!empty($tmp['content'])){
                    $tmp['content'] = strip_shortcodes(wp_trim_words($tmp['content'], 40, '...'));
                }                
                array_push($tmpLocations, $tmp);
            }
            return $tmpLocations;
        }  
        return null;      
    }

}