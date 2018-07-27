<?php 

namespace Neofonie\BusinessHours\Views;

use Neofonie\BusinessHours\Admin\Domain\Model\SimpleLocation;

class MetaContent {
    
    public function __construct() {       
        
    }

    public function init() {
        add_filter('the_content', array($this,'render')); //gets our meta data and dispayed it before the content
    }

    public function render($content) {
        global $post, $post_type;

        //display meta only on our locations (and if its a single location)
        if($post_type == 'neofonie_locations' && is_singular('neofonie_locations')){

            $location = new SimpleLocation();
            $location->loadByPostID($post->ID);                
            
            ob_start(); // turn on output buffering            
            include(BASE_PATH. 'src/TemplateParts/SimpleLocation-MetaContent.php');                                 
            $html = ob_get_contents(); // get the contents of the output buffer
            ob_end_clean();

            $html .= $content;
    
            return $html;  
    
    
        }else{
            return $content;
        }
    
    }
}