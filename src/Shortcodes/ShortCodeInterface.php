<?php

namespace Neofonie\BusinessHours\Shortcodes;


interface ShortCodeInterface {
 
    public function init();    
    public function register($atts, $content = null, $tag);    
     
}