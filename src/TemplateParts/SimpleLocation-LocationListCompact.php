<?php 
if(sizeof($locations) > 1 ) {
    $row = $this->values['use_horizontal_list'] ? 'neo-businesshours_list--row' : '';
    echo '<article class="neo-businesshours_list ' . $row . ' cf">';
} 
else {
    echo '<article>';
}
?>

<?php     
//foreach location
foreach($locations as $location){
    echo '<section class="neo-businesshours_item neo-businesshours_item--compact">';    
    //apply the filter before our main content starts 
    //(lets third parties hook into the HTML output to output data)    
    do_action('neofonie_location_before_main_content',$location['id']);
    $neoLocation = $location['simpleLocation'];    
    ?>
    
    <h3 class="neo-businesshours_item_title">
        <?php echo $location['title'] ?>                  
    </h3>    
    <p class="neo-businesshours_item_content">        
        <?php echo $neoLocation->street ?> 
        <?php echo $neoLocation->number ?>
        </br>
        <?php echo $neoLocation->zipCode ?> 
        <?php echo $neoLocation->city ?>          
        <br />    
        <?php echo $location->country ? $location->country.'<br />' : ''?>

        <?php                
            $locationTradingHourDays = $neoLocation->tradingHourDays->getCombinedContent();
            if(sizeof($locationTradingHourDays) === 1){
                echo __("deafult opening time", 'neofonie-business-hours') .' <br />';
                echo __('from ', 'neofonie-business-hours') . $locationTradingHourDays[0]['timezones'] . __(' o\'clock', 'neofonie-business-hours');                    
            } elseif( sizeof($locationTradingHourDays) > 1 ) {                    
                $dayList = $neoLocation->tradingHourDays->getContent();
                $openingTime = $dayList[$neoLocation->tradingHourDays->getToday()];
                echo __("today", 'neofonie-business-hours') .' <br />';
                echo __('from ', 'neofonie-business-hours') . $openingTime . __(' o\'clock', 'neofonie-business-hours');                                                           
            }
        ?>   

    </p>
    <hr />
    <?php           
        if($neoLocation->tradingHourDays->isOpen()) {
            echo "<p class=\"neo-businesshours_item_state neo-businesshours_item_state--open\">" . __('open', 'neofonie-business-hours') ."</p>";            
        } else {
            echo "<p class=\"neo-businesshours_item_state neo-businesshours_item_state--close\">" .__('close', 'neofonie-business-hours') . "</p>";
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