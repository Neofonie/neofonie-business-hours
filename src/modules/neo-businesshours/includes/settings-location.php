<?php
    //collect variables
    $location_id = (isset($settings->location_id) ? $settings->location_id : 'default');
    $number_of_locations = (isset($settings->number_of_locations) ? $settings->number_of_locations : 5);
    $location_args = array(
        'posts_per_page'    => -1,
        'post_type'         => \Neofonie\BusinessHours\SubPlugins\SimpleLocation::POST_TYPE
    );    
    $locations = get_posts($location_args);        
    include(BASE_PATH. 'src/TemplateParts/SimpleLocation-ModuleForm.php');          
?>

