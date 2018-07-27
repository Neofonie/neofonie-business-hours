<?php

/**
 * @class NeoBusinesshours
 */
class NeoBusinesshours extends FLBuilderModule {
    public function __construct() {
        parent::__construct(array(
            'name'            => __( 'Neo Businesshours', 'neofonie-business-hours' ),
            'description'     => __( 'A module to show the opening hours by location', 'neofonie-business-hours' ),
         //   'group'           => __( 'Neofonie Modules', 'neofonie-business-hours' ),
            'category'        => __( 'Content Modules', 'neofonie-business-hours' ),
            'dir'             => BASE_PATH . 'src/modules/neo-businesshours/',
            'url'             => BASE_URL . 'src/modules/neo-businesshours/',
            'icon'            => 'clock.svg',
            'editor_export'   => true, // Defaults to true and can be omitted.
            'enabled'         => true, // Defaults to true and can be omitted.
            'partial_refresh' => false, // Defaults to false and can be omitted.
        ));
    }
}    

FLBuilder::register_module( 'NeoBusinesshours', array(    
    'include'       => array( // Tab
        'title'         => __('Basics', 'neofonie-business-hours'), // Tab title
        'file'          => BASE_PATH. 'src/modules/neo-businesshours/includes/settings-location.php'
    )
) );