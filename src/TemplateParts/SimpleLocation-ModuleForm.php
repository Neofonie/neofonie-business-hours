<div class="fl-builder-settings-section">

    <h3 class="fl-builder-settings-title"><?php _e('Neo Location', 'neofonie-business-hours'); ?></h3>            
    <p><?php _e('Select your options below', 'neofonie-business-hours'); ?></p>

    <table class="fl-form-table">
        <tr>
            <th><?php _e('Location to display', 'neofonie-business-hours'); ?></th>
            <td>                
                <select class="widefat" name="location_id" value="<?php echo $location_id; ?>">
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
            </td>                    
        </tr>
        <tr>
            <th>                
                <?php _e('Display compact items', 'neofonie-business-hours'); ?>
            </th>
            <td>           
                <input type="checkbox" name="use_compact_list" <?php if($settings->use_compact_list) { echo"checked=checked"; } ?>/>                
            </td>
        </tr>        
        <tr>
            <th>                
                <?php _e('Display horizontal list', 'neofonie-business-hours'); ?>
            </th>
            <td>           
                <input type="checkbox" name="use_horizontal_list" <?php if($settings->use_horizontal_list) { echo"checked=checked"; } ?>/>                
            </td>
        </tr>
        <tr>
            <th>
                <small><?php _e('If you want to display multiple locations select how many below', 'neofonie-business-hours'); ?></small>
                <br/>
                <?php _e('Number of Locations', 'neofonie-business-hours'); ?>
            </th>
            <td>           
                <select class="widefat" name="number_of_locations" value="<?php echo $number_of_locations; ?>">
                    <option value="default" <?php if($number_of_locations == 'default'){ echo 'selected';}?>><?php _e('All Locations', 'neofonie-business-hours')?></option>
                    <option value="1" <?php if($number_of_locations == '1'){ echo 'selected';}?>>1</option>
                    <option value="2" <?php if($number_of_locations == '2'){ echo 'selected';}?>>2</option>
                    <option value="3" <?php if($number_of_locations == '3'){ echo 'selected';}?>>3</option>
                    <option value="4" <?php if($number_of_locations == '4'){ echo 'selected';}?>>4</option>
                    <option value="5" <?php if($number_of_locations == '5'){ echo 'selected';}?>>5</option>
                    <option value="10" <?php if($number_of_locations == '10'){ echo 'selected';}?>>10</option>
                </select>            
            </td>
        </tr>  
        <tr>
            <th><?php _e('Want to edit your locations?', 'neofonie-business-hours'); ?></th>
            <td>           
            <p>
                <a href="<?php echo get_admin_url(); ?>edit.php?post_type=neofonie_locations" target="_blank"><?php _e('Go to locations', 'neofonie-business-hours'); ?></a>
            </p>
            </td>
        </tr>              
    </table>

</div>