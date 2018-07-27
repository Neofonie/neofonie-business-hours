<?php 
if(sizeof($locations) > 1 ) {
    $row = $this->values['use_horizontal_list'] ? 'neo-businesshours_list--row' : '';
    echo '<article class="neo-businesshours_list' . $row . ' cf">';
} 
else {
    echo '<article>';
}
?>

<?php     
//foreach location
foreach($locations as $location){
    echo '<section class="neo-businesshours_item">';    
    //apply the filter before our main content starts 
    //(lets third parties hook into the HTML output to output data)    
    do_action('neofonie_location_before_main_content',$location['id']);
    $neoLocation = $location['simpleLocation'];    
    ?>
    
    <h2 class="neo-businesshours_item_title">
        <?php echo $location['title'] ?>                  
    </h2>   

    <?php
        echo '<div class="neo-businesshours_item_content neo-businesshours_item_content--address">';    
            echo $neoLocation->street . $neoLocation->number . '<br />';
            echo $neoLocation->zipCode . $neoLocation->city . '<br />';  
            echo $neoLocation->country ? $neoLocation->country .'<br />' : '';
        echo '</div>';    

        if( $neoLocation->getPhone() || $neoLocation->getEmail() || $neoLocation->getPublicTransport() || $neoLocation->getGooglePlace() ) {            
            echo '<div class="neo-businesshours_item_content neo-businesshours_item_content--contact" >';
                if( !empty($neoLocation->getPhone()) ) {
                    echo '<span class="neo-businesshours_item_label">' . __('Phone', 'neofonie-business-hours') . '</span> ';
                    echo '<a href="tel:+' . $neoLocation->getInternationalPhone() . '">'. $neoLocation->phone . "</a><br />";
                }
                if( !empty($neoLocation->getEmail()) ) {    
                    echo '<span class="neo-businesshours_item_label">'. __('Email', 'neofonie-business-hours') . '</span> ';
                    echo '<a href="mailto:'. $neoLocation->email .'">' . $neoLocation->email . "</a><br />";
                }
                if( !empty($neoLocation->getPublicTransport()) ) {    
                    echo '<span class="neo-businesshours_item_label">'. __('Public transport', 'neofonie-business-hours') . '</span> ' . $neoLocation->publicTransport . "<br />";
                }
                if($neoLocation->getgooglePlace()) {
                    echo '<a href="'. $neoLocation->googlePlace . '" title="'. __('Location at google place', 'neofonie-business-hours') .'">'. __('Location at google place', 'neofonie-business-hours') . '</a><br /> ';                    
                }  
            echo '</div>';
        }   

        echo '<div class="neo-businesshours_item_content neo-businesshours_item_content--business-hours" >';
            echo '<span class="neo-businesshours_item_label">'. __('Business Hours', 'neofonie-business-hours') . '</span><br /> ';                
            
            $locationTradingHourDays = $neoLocation->tradingHourDays->getCombinedContent();                
            if(sizeof($locationTradingHourDays) === 1){
                echo __("deafult opening time", 'neofonie-business-hours') .' ';                
                echo __('from ', 'neofonie-business-hours') . $locationTradingHourDays[0]['timezones'] . __(' o\'clock', 'neofonie-business-hours');
                if($neoLocation->tradingHourDays->isOpen()) {
                    echo "<span class=\"neo-businesshours_item_state neo-businesshours_item_state--open\">" . __('open', 'neofonie-business-hours') ."</span>";            
                } else {
                    echo "<span class=\"neo-businesshours_item_state neo-businesshours_item_state--close\">" .__('close', 'neofonie-business-hours') . "</span>";
                }   
                echo $neoLocation->getHint() ? '<br /> (' . $neoLocation->hint . ')' : '';                                                          
            } elseif( sizeof($locationTradingHourDays) > 1 ) {                
                foreach($locationTradingHourDays as $combinedDays) {
                    echo '<span class="neo-businesshours_item_label neo-businesshours_item_label--days">' . implode(", ",$combinedDays['dayLabels']) . '</span> <br />';
                    echo __('from ', 'neofonie-business-hours') . $combinedDays['timezones'] . __(' o\'clock', 'neofonie-business-hours');
                    if(in_array($neoLocation->tradingHourDays->getToday(), $combinedDays['days'])) {
                        if($neoLocation->tradingHourDays->isOpen()) {
                            echo "<span class=\"neo-businesshours_item_state neo-businesshours_item_state--open\">" . __('open', 'neofonie-business-hours') ."</span>";            
                        } else {
                            echo "<span class=\"neo-businesshours_item_state neo-businesshours_item_state--close\">" .__('close', 'neofonie-business-hours') . "</span>";
                        }
                    }
                    echo  "<br/>";
                }  
                echo $neoLocation->getHint() ? '(' . $neoLocation->hint . ')' : '';                             
            }                                           
        echo "</div>"; 

        if($neoLocation->getOffer()) {
            echo '<div class="neo-businesshours_item_content neo-businesshours_item_content--additional-informations" >';
            if($neoLocation->getOffer()) {
                echo '<span class="neo-businesshours_item_label">'. __('Offer', 'neofonie-business-hours') . '</span><br /> ';
                echo $neoLocation->offer;
            }                            
            echo '</div>';
        }
        
    ?>
           
      
   
    <?php
    //apply the filter after the main content, before it ends 
    //(lets third parties hook into the HTML output to output data)    
    do_action('neofonie_location_meta_data_output_end',$location['id']);
    ?>     
    
    </section>
<?php    
}
?>
</article>
<div class="cf"></div>    