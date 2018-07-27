<?php 

namespace Neofonie\BusinessHours\Widgets;

use Neofonie\BusinessHours\Admin\Domain\Model\SimpleLocation;
use Neofonie\BusinessHours\Views\LocationList;

class LocationWidget extends \WP_Widget {
    //initialise widget values
    public function __construct(){
        //set base values for the widget (override parent)
        parent::__construct(
            'neofonie_location_widget',                        
            'Neofonie Location Widget', 
            array('description' => 'A widget that displays your locations')
        );        
    }

    public function init() {
        add_action('widgets_init',array($this,'register'));
    }

    public function register() {        
        register_widget('\Neofonie\BusinessHours\Widgets\LocationWidget');                  
    }

    //handles the back-end admin of the widget
    //$instance - saved values for the form
    public function form($instance) {                
        //collect variables 
        $location_id = (isset($instance['location_id']) ? $instance['location_id'] : 'default');
        $number_of_locations = (isset($instance['number_of_locations']) ? $instance['number_of_locations'] : 5);
        $use_compact_list = (isset($instance['use_compact_list']) ? $instance['use_compact_list'] : false);
        $use_horizontal_list = (isset($instance['use_horizontal_list']) ? $instance['use_horizontal_list'] : false);
        
        $location_args = array(
            'posts_per_page'    => -1,
            'post_type'         => \Neofonie\BusinessHours\SubPlugins\SimpleLocation::POST_TYPE
        );
        $locations = get_posts($location_args);      

        include(BASE_PATH. 'src/TemplateParts/SimpleLocation-WidgetForm.php');          
    }

    //handles updating the widget 
    //$new_instance - new values, $old_instance - old saved values
    public function update($new_instance, $old_instance){        

        $instance = array();

        $instance['location_id'] = $new_instance['location_id'];
        $instance['number_of_locations'] = $new_instance['number_of_locations'];
        $instance['use_compact_list'] = $new_instance['use_compact_list'];
        $instance['use_horizontal_list'] = $new_instance['use_horizontal_list'];
        return $instance;        
    }

    //handles public display of the widget
    //$args - arguments set by the widget area, $instance - saved values
    public function widget( $args, $instance ) {       
        $locationList = new LocationList();                

        //pass any arguments if we have any from the widget
        $arguments = array();
        
        //if we specify a single location
        if($instance['location_id'] != 'default'){
            $arguments['location_id'] = $instance['location_id'];
        }
        //if we specify a number of locations
        if($instance['number_of_locations'] != 'default'){
            $arguments['number_of_locations'] = $instance['number_of_locations'];
        } 
        //if we specify compact list
        if($instance['use_compact_list'] != false){
            $arguments['use_compact_list'] = $instance['use_compact_list'];
        }            
        //if we specify horizontal list
        if($instance['use_horizontal_list'] != false){
            $arguments['use_horizontal_list'] = $instance['use_horizontal_list'];
        }    
       
        //get the output
        $html = '';
        $html .= $args['before_widget'];
        $html .= $args['before_title'];
        $html .= 'Neofonie Locations';
        $html .= $args['after_title'];        
        $html .= $locationList->render($arguments);
        $html .= $args['after_widget'];
        echo $html;        
    }

}