<div class="fl-neo-businesshours">
    <?php        
        $locationList = new Neofonie\BusinessHours\Views\LocationList();                
        echo $locationList->render((array)$settings);
    ?>  
</div>