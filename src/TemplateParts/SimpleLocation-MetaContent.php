<section class="neo-businesshours_meta-data">
    <?php
    //hook for outputting additional meta data (at the start of the form)
    do_action('neofonie_location_meta_data_output_start',$post->ID);

   

    echo '<div class="neo-businesshours_item_content neo-businesshours_item_content--address">';    
        echo $location->street . $location->number . '<br />';
        echo $location->zipCode . $location->city . '<br />';  
        echo $location->country ? $location->country .'<br />' : '';
    echo '</div>';    

    if( $location->getPhone() || $location->getEmail() || $location->getPublicTransport() || $location->getGooglePlace() ) {            
        echo '<div class="neo-businesshours_item_content neo-businesshours_item_content--contact" >';
            if( !empty($location->getPhone()) ) {
                echo '<span class="neo-businesshours_item_label">' . __('Phone', 'neofonie-business-hours') . '</span> ';
                echo '<a href="tel:+' . $location->getInternationalPhone() . '">'. $location->phone . "</a><br />";
            }
            if( !empty($location->getEmail()) ) {    
                echo '<span class="neo-businesshours_item_label">'. __('Email', 'neofonie-business-hours') . '</span> ';
                echo '<a href="mailto:'. $location->email .'">' . $location->email . "</a><br />";
            }
            if( !empty($location->getPublicTransport()) ) {    
                echo '<span class="neo-businesshours_item_label">'. __('Public transport', 'neofonie-business-hours') . '</span> ' . $location->publicTransport . "<br />";
            }
            if($location->getgooglePlace()) {
                echo '<a href="'. $location->googlePlace . '" title="'. __('Location at google place', 'neofonie-business-hours') .'">'. __('Location at google place', 'neofonie-business-hours') . '</a><br /> ';                    
            }  
        echo '</div>';
    }   

    echo '<div class="neo-businesshours_item_content neo-businesshours_item_content--business-hours" >';
        echo '<span class="neo-businesshours_item_label">'. __('Business Hours', 'neofonie-business-hours') . '</span><br /> ';                
        
        $locationTradingHourDays = $location->tradingHourDays->getCombinedContent();                
        if(sizeof($locationTradingHourDays) === 1){
            echo __("deafult opening time", 'neofonie-business-hours') .' ';                
            echo __('from ', 'neofonie-business-hours') . $locationTradingHourDays[0]['timezones'] . __(' o\'clock', 'neofonie-business-hours');
            if($location->tradingHourDays->isOpen()) {
                echo "<span class=\"neo-businesshours_item_state neo-businesshours_item_state--open\">" . __('open', 'neofonie-business-hours') ."</span>";            
            } else {
                echo "<span class=\"neo-businesshours_item_state neo-businesshours_item_state--close\">" .__('close', 'neofonie-business-hours') . "</span>";
            }   
            echo $location->getHint() ? '<br /> (' . $location->hint . ')' : '';                                                          
        } elseif( sizeof($locationTradingHourDays) > 1 ) {                
            foreach($locationTradingHourDays as $combinedDays) {
                echo '<span class="neo-businesshours_item_label neo-businesshours_item_label--days">' . implode(", ",$combinedDays['dayLabels']) . '</span> <br />';
                echo __('from ', 'neofonie-business-hours') . $combinedDays['timezones'] . __(' o\'clock', 'neofonie-business-hours');
                if(in_array($location->tradingHourDays->getToday(), $combinedDays['days'])) {                    
                    if($location->tradingHourDays->isOpen()) {
                        echo "<span class=\"neo-businesshours_item_state neo-businesshours_item_state--open\">" . __('open', 'neofonie-business-hours') ."</span>";            
                    } else {
                        echo "<span class=\"neo-businesshours_item_state neo-businesshours_item_state--close\">" .__('close', 'neofonie-business-hours') . "</span>";
                    }
                }
                echo  "<br/>";
            }  
            echo $location->getHint() ? '(' . $location->hint . ')' : '';                             
        }                                           
    echo "</div>";     

    if($location->getOffer()) {
        echo '<div class="neo-businesshours_item_content neo-businesshours_item_content--additional-informations" >';
        if($location->getOffer()) {
            echo '<span class="neo-businesshours_item_label">'. __('Offer', 'neofonie-business-hours') . '</span><br /> ';
            echo $location->offer;
        }                            
        echo '</div>';
    }

    
    //hook for outputting additional meta data (at the end of the form)
    do_action('neofonie_location_meta_data_output_end',$post->ID);
    ?>
</section>