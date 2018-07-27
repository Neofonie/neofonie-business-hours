<?php

namespace Neofonie\BusinessHours\Shortcodes;

use Neofonie\BusinessHours\Views\LocationList;

class LocationListShortcode implements ShortCodeInterface  {

    public function init() {        
        add_shortcode('neo_locations', array($this,'register'));       
    }

    public function register($atts, $content = null, $tag) {
        $locationList = new LocationList();        
        //build default arguments
        $arguments = shortcode_atts(LocationList::DEFAULT_VALUES,$atts,$tag);        

        return $locationList->render($arguments);
    }

}
