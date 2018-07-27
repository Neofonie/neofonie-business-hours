<p><?php _e('Select your options below', 'neofonie-business-hours'); ?></p>
<p>
    <label for="<?php echo $this->get_field_name('location_id'); ?>"><?php _e('Location to display', 'neofonie-business-hours'); ?></label>
    <select class="widefat" name="<?php echo $this->get_field_name('location_id'); ?>" id="<?php echo $this->get_field_id('location_id'); ?>" value="<?php echo $location_id; ?>">
        <option value="default"><?php _e('All Locations', 'neofonie-business-hours')?></option>
        <?php       
        if($locations){
            foreach($locations as $location){
                if($location->ID == $location_id){
                    echo '<option selected value="' . $location->ID . '">' . get_the_title($location->ID) . '</option>';
                }else{
                    echo '<option value="' . $location->ID . '">' . get_the_title($location->ID) . '</option>';
                }
            }
        }
        ?>
    </select>
</p>
<p>
    <label for="<?php echo $this->get_field_name('use_compact_list'); ?>"><?php _e('Display compact items', 'neofonie-business-hours'); ?></label>
    <input type="checkbox" name="<?php echo $this->get_field_name('use_compact_list'); ?>" id="<?php echo $this->get_field_id('use_compact_list'); ?>" <?php if($use_compact_list) { echo"checked=checked"; } ?>/>                
</p>
<p>
   <label for="<?php echo $this->get_field_name('use_horizontal_list'); ?>"><?php _e('Display horizontal list', 'neofonie-business-hours'); ?></label>
    <input type="checkbox" name="<?php echo $this->get_field_name('use_horizontal_list'); ?>" id="<?php echo $this->get_field_id('use_horizontal_list'); ?>" <?php if($use_horizontal_list) { echo"checked=checked"; } ?>/>                 
</p>
<p>
    <small><?php _e('If you want to display multiple locations select how many below', 'neofonie-business-hours'); ?></small><br/>
    <label for="<?php echo $this->get_field_id('number_of_locations'); ?>"> <?php _e('Number of Locations', 'neofonie-business-hours'); ?></label>
    <select class="widefat" name="<?php echo $this->get_field_name('number_of_locations'); ?>" id="<?php echo $this->get_field_id('number_of_locations'); ?>" value="<?php echo $number_of_locations; ?>">
        <option value="default" <?php if($number_of_locations == 'default'){ echo 'selected';}?>><?php _e('All Locations', 'neofonie-business-hours')?></option>
        <option value="1" <?php if($number_of_locations == '1'){ echo 'selected';}?>>1</option>
        <option value="2" <?php if($number_of_locations == '2'){ echo 'selected';}?>>2</option>
        <option value="3" <?php if($number_of_locations == '3'){ echo 'selected';}?>>3</option>
        <option value="4" <?php if($number_of_locations == '4'){ echo 'selected';}?>>4</option>
        <option value="5" <?php if($number_of_locations == '5'){ echo 'selected';}?>>5</option>
        <option value="10" <?php if($number_of_locations == '10'){ echo 'selected';}?>>10</option>
    </select>
</p>
<p>
    <?php _e('Want to edit your locations?', 'neofonie-business-hours'); ?>        
    <p>
        <a href="<?php echo get_admin_url(); ?>edit.php?post_type=neofonie_locations" target="_blank"><?php _e('Go to locations', 'neofonie-business-hours'); ?></a>
    </p>
</p>
