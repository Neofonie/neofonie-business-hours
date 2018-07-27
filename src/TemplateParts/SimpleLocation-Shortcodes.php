<div class="wrap">
    <h1 class="wp-heading-inline"><?php _e('Shortcodes description','neofonie-business-hours') ?></h1>
    <hr class="wp-header-end">
    <div class="neo-businesshours_settings neo-businesshours_settings--shortcodes">
        <div class="neo-businesshours_field-container">
            <h3><?php _e('List Displays','neofonie-business-hours') ?></h3>
            <div class="neo-businesshours_field">
                <label><?php _e('Default list (vertical) with full data', 'neofonie-business-hours')?></label>
                <input type="text" disabled="disabled" value="[neo_locations]"></input>
            </div>
            <div class="neo-businesshours_field">
                <label><?php _e('List (horizontal) with full data', 'neofonie-business-hours')?></label>
                <input type="text" disabled="disabled" value="[neo_locations use_horizontal_list=`true`]"></input>
            </div>
            <div class="neo-businesshours_field">
                <label><?php _e('Compact list (vertical)', 'neofonie-business-hours')?></label>
                <input type="text" disabled="disabled" value="[neo_locations use_compact_list=`true`]"></input>
            </div>
            <div class="neo-businesshours_field">
                <label><?php _e('Compact list (horizontal)', 'neofonie-business-hours')?></label>
                <input type="text" disabled="disabled" value="[neo_locations use_compact_list=`true` use_horizontal_list=`true`]"></input>
            </div>            
            <h3><?php _e('List settings','neofonie-business-hours') ?></h3>
            <small> <?php _e('Here are some usefull list settings you can additional use.','neofonie-business-hours')?></small> 
            <div class="neo-businesshours_field">
                <label><?php _e('List with x locations', 'neofonie-business-hours')?></label>
                <input type="text" disabled="disabled" value="[neo_locations number_of_locations=`3`]"></input>
            </div>
            <div class="neo-businesshours_field">
                <label><?php _e('List ordered by ... (defaulft is ID)', 'neofonie-business-hours')?></label>
                <input type="text" disabled="disabled" value="[neo_locations orderby=`ORDERBY`]"></input>
            </div>
            <div class="neo-businesshours_field">
                <label><?php _e('List order (DESC or ASC, defaulft is ASC)', 'neofonie-business-hours')?></label>
                <input type="text" disabled="disabled" value="[neo_locations order=`DESC`]"></input>
            </div>
            <a href="https://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank"><?php _e('Click here to see all orderby options','neofonie-business-hours')?></a>
            <h3><?php _e('Single Location','neofonie-business-hours') ?></h3>            
            <div class="neo-businesshours_field">
                <label><?php _e('Single Location by id (post->ID)', 'neofonie-business-hours')?></label>
                <input type="text" disabled="disabled" value="[neo_locations location_id=`LOCATION_ID`]"></input>
            </div>
            <div class="neo-businesshours_field">
                <label><?php _e('Single Location by name (post_title)', 'neofonie-business-hours')?></label>
                <input type="text" disabled="disabled" value="[neo_locations name=`LOCATION_NAME`]"></input>
            </div>            
            <div class="neo-businesshours_field">
                <label><?php _e('Compact single Location by name (post_title)', 'neofonie-business-hours')?></label>
                <input type="text" disabled="disabled" value="[neo_locations name=`LOCATION_NAME` use_compact_list=`true`]"></input>
            </div>
        </div>
    </div>
</div>