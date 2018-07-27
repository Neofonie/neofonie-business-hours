<?php 

namespace Neofonie\BusinessHours\Admin\MetaBoxes\SimpleLocation;

use Neofonie\BusinessHours\SubPlugins\SimpleLocation;


/**
 * Represents a meta box to be displayed ...
 */
class MetaBox {
 
    /**
     * A reference to the Meta Box Display.
     *
     * @access private
     * @var    MetaBoxDisplay
     */
    private $display;
 
    /**
     * Initializes this class by setting its display property equal to that of
     * the incoming object.
     *
     * @param MetaBoxDisplay $display Displays the contents of this meta box.
     */
    public function __construct( $display ) {
        $this->display = $display;
    }

    public function init() {
		add_action('add_meta_boxes', array($this, 'addMetabox'));
	}

	/**
	 * Registers this meta box with WordPress.
	 *	
	 */
	public function addMetabox() {
		add_meta_box( 
            'neo-businesshours', // id
            __('Location Information','neofonie-business-hours'), // name
             array(	$this->display,'render' ), //display function
            SimpleLocation::POST_TYPE, // post type
            'normal', //location            
            'default' //priority
        );
	}

}