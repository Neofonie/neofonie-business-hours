<?php 

namespace Neofonie\BusinessHours\Admin\MetaBoxes\SimpleLocation;

use Neofonie\BusinessHours\Admin\Domain\Model\SimpleLocation;

/**
 * Displays the location meta box
 */
class MetaBoxDisplay {


    /**
     * @var \Neofonie\BusinessHours\Widgets\SimpleLocation
     */
    private $locationTradingHourDays;

    /**
     * @param \Neofonie\BusinessHours\Widgets\SimpleLocation
     */
    public function __construct(&$locationTradingHourDays) {
       $this->locationTradingHourDays = $locationTradingHourDays;
    }

    public function render($post) {
        //set nonce field
        wp_nonce_field('neofonie_location_nonce', 'neofonie_location_nonce_field');        
        /**
         * @var \Neofonie\BusinessHours\Admin\Model\SimpleLocation
         */
        $location = new SimpleLocation();
        $location->loadByPostID($post->ID);                     
        include(BASE_PATH. 'src/TemplateParts/SimpleLocation-MetaBoxForm.php');  
    }
}