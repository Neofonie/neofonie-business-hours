<p><?php _e('Enter your information for the current location.', 'neofonie-business-hours'); ?> </p>
<div class="neo-businesshours_settings">
        <?php 
        //before main form elements hook
        do_action('neofonie_location_admin_form_start'); 
        ?>
        <div class="neo-businesshours_settings-block">
            <div class="neo-businesshours_field-container">
                <h3><?php _e('Contact data', 'neofonie-business-hours'); ?></h3>
                <div class="neo-businesshours_field">
                    <label for="neofonie_location_areaCode"><?php _e('Area Code like 49 for germany', 'neofonie-business-hours'); ?></label>            
                    <input type="tel" name="neofonie_location_areaCode" id="neofonie_location_areaCode" value="<?php echo $location->areaCode;?>"/>
                </div>
                <div class="neo-businesshours_field">
                    <label for="neofonie_location_phone"><?php _e('Phone', 'neofonie-business-hours'); ?></label>            
                    <input type="tel" name="neofonie_location_phone" id="neofonie_location_phone" value="<?php echo $location->getPhone();?>"/>
                </div>
                <div class="neo-businesshours_field">
                    <label for="neofonie_location_email"><?php _e('Email', 'neofonie-business-hours'); ?></label>            
                    <input type="email" name="neofonie_location_email" id="neofonie_location_email" value="<?php echo $location->getEmail();?>"/>
                </div>
            </div>
            <div class="neo-businesshours_field-container">    
                <h3><?php _e('Address', 'neofonie-business-hours'); ?></h3>        
                <div class="neo-businesshours_field">            
                    <label for="neofonie_location_street"><?php _e('Street', 'neofonie-business-hours'); ?></label>            
                    <input type="text" name="neofonie_location_street" id="neofonie_location_street" value="<?php echo $location->getStreet();?>"/>
                </div>
                <div class="neo-businesshours_field">                
                    <label for="neofonie_location_street"><?php _e('House Number', 'neofonie-business-hours'); ?></label>            
                    <input type="text" name="neofonie_location_number" id="neofonie_location_number" value="<?php echo $location->getNumber();?>"/>
                </div>
                <div class="neo-businesshours_field">                
                    <label for="neofonie_location_zipCode"><?php _e('Zip Code', 'neofonie-business-hours'); ?></label>            
                    <input type="text" name="neofonie_location_zipCode" id="neofonie_location_zipCode" value="<?php echo $location->getZipCode();?>"/>
                </div>
                <div class="neo-businesshours_field">            
                    <label for="neofonie_location_city"><?php _e('City', 'neofonie-business-hours'); ?></label>            
                    <input type="text" name="neofonie_location_city" id="neofonie_location_city" value="<?php echo $location->getCity();?>"/>            
                </div>
                <div class="neo-businesshours_field">            
                    <label for="neofonie_location_country"><?php _e('Country', 'neofonie-business-hours'); ?></label>            
                    <input type="text" name="neofonie_location_country" id="neofonie_location_country" value="<?php echo $location->getCountry();?>"/>            
                </div>
            </div>
            <div class="neo-businesshours_field-container">
                <h3><?php _e('Additional informations', 'neofonie-business-hours'); ?></h3>
                <div class="neo-businesshours_field">
                    <label for="neofonie_location_hint"><?php _e('Hint', 'neofonie-business-hours'); ?></label>            
                    <input type="text" name="neofonie_location_hint" id="neofonie_location_hint" value="<?php echo $location->hint;?>"/>
                </div>                
                <div class="neo-businesshours_field">
                    <label for="neofonie_location_publicTransport"><?php _e('Public transport', 'neofonie-business-hours'); ?></label>            
                    <input type="text" name="neofonie_location_publicTransport" id="neofonie_location_publicTransport" value="<?php echo $location->publicTransport;?>"/>
                </div>
                <div class="neo-businesshours_field">
                    <label for="neofonie_location_googlePlace"><?php _e('Google place', 'neofonie-business-hours'); ?></label>            
                    <input type="text" name="neofonie_location_googlePlace" id="neofonie_location_googlePlace" value="<?php echo $location->googlePlace;?>"/>
                </div>
                <div class="neo-businesshours_field">
                    <label for="neofonie_location_offer"><?php _e('Offer', 'neofonie-business-hours'); ?></label>            
                    <textarea name="neofonie_location_offer" id="neofonie_location_offer" cols="24" rows="5"><?php echo $location->offer;?></textarea>
                </div>
            </div>
        </div>         
        <div class="neo-businesshours_settings-block">  
            <div class="neo-businesshours_field-container">    
                <h3><?php _e('Business Hours', 'neofonie-business-hours'); ?></h3>        
                <small> <?php _e('Please use the following business hours format: 09:00 - 19:45', 'neofonie-business-hours'); ?></small>
                <?php
                    //trading hours                
                    if(!empty($this->locationTradingHourDays)){
                        //go through all of our registered trading hour days
                        foreach($this->locationTradingHourDays as $day_key){
                            //collect trading hour meta data
                            $neofonie_location_trading_hour_value =  get_post_meta($post->ID,'neofonie_location_trading_hours_' . $day_key, true);                        
                            //dsiplay label and input
                            echo '<div class="neo-businesshours_field">';
                            echo '<label for="neofonie_location_trading_hours_' . $day_key . '">' . Neofonie\BusinessHours\Admin\Domain\Model\TradingHourDays::getDayLabel($day_key) . '</label>';
                            echo '<input type="text" name="neofonie_location_trading_hours_' . $day_key . '" id="neofonie_location_trading_hours_' . $day_key . '" value="' . $neofonie_location_trading_hour_value . '"/>';
                            echo '</div>';
                        }                
                    }  
                ?>
                <h3><?php _e('Closing settings', 'neofonie-business-hours'); ?></h3>                    
                <div class="neo-businesshours_field">
                    <label for="neofonie_location_close"><?php _e('Is close', 'neofonie-business-hours'); ?></label>            
                    <input type="checkbox" name="neofonie_location_close" id="neofonie_location_close" <?php if($location->tradingHourDays->isClose()) { echo"checked=checked"; } ?>/>
                </div>
                <small> <?php _e('Please use the following days format: 24.12, 25.12, 26.12', 'neofonie-business-hours'); ?></small>    
                <div class="neo-businesshours_field">
                    <label for="neofonie_location_holidays"><?php _e('Holidays', 'neofonie-business-hours'); ?></label>            
                    <input autocomplete="off" type="text" class="neo-businesshours_date" name="neofonie_location_holidays" id="neofonie_location_holidays" value="<?php echo $location->tradingHourDays->holidays;?>"/>
                </div>
            </div>
        </div>                      
    <?php 
    //after main form elements hook
    do_action('neofonie_location_admin_form_end'); 
    ?>
</div>