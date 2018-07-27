<?php 

namespace Neofonie\BusinessHours\Admin\Domain\Repository;

use Neofonie\BusinessHours\Admin\Domain\Model\SimpleLocation;

class SimpleLocationRepository {

    public function __construct() {
        add_action('save_post_neofonie_locations', array($this,'saveLocation')); 
    }

    public function saveLocation($postID) {       
        //check for nonce
        if(!isset($_POST['neofonie_location_nonce_field'])){
            return $postID;
        }   
        //verify nonce
        if(!wp_verify_nonce($_POST['neofonie_location_nonce_field'], 'neofonie_location_nonce')){
            return $postID;
        }
        //check for autosave
        if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE){
            return $postID;
        }

        $location = new SimpleLocation();
        $location->loadsAndUpdatesByPostVars($postID);            

        //location save hook 
        //used so you can hook here and save additional post fields added via 'neofonie_location_meta_data_output_end' or 'neofonie_location_meta_data_output_end'
        do_action('neofonie_location_admin_save',$postID, $_POST);

    }
}