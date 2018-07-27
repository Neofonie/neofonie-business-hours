<?php 

namespace Neofonie\BusinessHours\Admin\Domain\Model;

class TradingHourDays implements ModelInterface {    

    const SLUG = 'neofonie_location_trading_hours_'; 
    const DAYS = [
        'monday',
        'tuesday',
        'wednesday',
        'thursday' ,
        'friday',
        'saturday',
        'sunday'
    ];

    /**
     * @var array
     */
    private $locationTradingHourDays;  
    /**
     * @var string
     */
    private $holidays;
    /**
     * @var boolean
     */     
    private $close;


    public function __construct() {                                               
        $this->locationTradingHourDays = array();
    }

    public function loadByPostID($postID) {           
        foreach( TradingHourDays::DAYS as $key ){ 
            $value = get_post_meta($postID,TradingHourDays::SLUG.$key,true);
            if(isset($value)) {
                $this->locationTradingHourDays[$key] = $value;
            }                                             
        }        
        foreach ($this as $key => $value) {            
            if($this->$key == $this->locationTradingHourDays) {                                               
                continue;               
            } 
            $this->$key = get_post_meta($postID,SimpleLocation::SLUG.$key,true);                        
        }          
    }

    public function loadsAndUpdatesByPostVars($postID) {                       
        foreach( TradingHourDays::DAYS as $key ){                          
            $this->locationTradingHourDays[$key] = isset($_POST[TradingHourDays::SLUG.$key]) ? sanitize_text_field($_POST[TradingHourDays::SLUG.$key]) : '';
            update_post_meta($postID, TradingHourDays::SLUG.$key, $this->locationTradingHourDays[$key]);
        } 
        foreach ($this as $key => $value) {            
            if($this->$key == $this->locationTradingHourDays) {                                               
                continue;               
            } 
            $this->$key = isset($_POST[SimpleLocation::SLUG.$key]) ? sanitize_text_field($_POST[SimpleLocation::SLUG.$key]) : '';                        
            update_post_meta($postID, SimpleLocation::SLUG.$key, $this->$key);           
        }        
    }
    
    public function getAllProperties() {
        $properties = array();
        foreach ($this as $key => $value) { 
            $properties[$key] = $value;
        }           
        return $properties;
    }

    public function __get($property) {
       if (property_exists($this, $property)) {  
          return $this->$property;  
       }  
    }

    public function getHolidays() {
        return $this->holidays;
    }

    public function isClose() {
        return $this->close;
    }

    /**
     * Returns all opening times for each day
     */
    public function getContent() {
        return $this->locationTradingHourDays;
    }    

    /**
     * Returns all opening times ordered with days and has day labels
     */
    public function getCombinedContent() {
        $combinedDays = array();
        foreach($this->locationTradingHourDays as $key => $value) {
            if(!empty($value)) {
                $index = FALSE;            
                if(!empty($combinedDays)) {
                    $index = array_search( $value , array_column($combinedDays, 'timezones') );
                }          
                if(!empty($combinedDays) && $index !== FALSE ) {                
                    $combinedDays[$index]['days'][] = $key;
                    $combinedDays[$index]['dayLabels'][] = TradingHourDays::getDayLabel($key);
                } else {               
                    $combinedDays[] = ['days' => array($key), 'timezones' => $value, 'dayLabels' =>array(TradingHourDays::getDayLabel($key)) ];
                }                          
            }                      
        }        
        return $combinedDays;
    }    

    public function isOpen(){ 
        if($this->close) {
            return false;
        }        
        $timestamp = current_time('timestamp');                    
        $today = lcfirst( date("l", $timestamp) );
        $time = date('H:i', $timestamp);        
        $currentopenTimeZones = explode('-', $this->locationTradingHourDays[$today]);        
        if( strtotime($time) > strtotime($currentopenTimeZones[0]) && strtotime($time) < strtotime($currentopenTimeZones[1]) ) {    
            // check if today is a holiday        
            if(!empty($this->holidays) && strpos($this->holidays, date('d.m', $timestamp)) !== false) {                
                return false;                            
            }
            return true;
        }
        return false;                
    }

    public function getToday() {
        $timestamp = current_time('timestamp');                    
        return lcfirst( date("l", $timestamp) );
    }
   
    public static function getDayLabel($day){
        $days = array(
            'monday' => __('Monday','neofonie-business-hours'),
            'tuesday' => __('Tuesday','neofonie-business-hours'),
            'wednesday' => __('Wednesday','neofonie-business-hours'),
            'thursday' => __('Thursday','neofonie-business-hours'),
            'friday' => __('Friday','neofonie-business-hours'),
            'saturday' => __('Saturday','neofonie-business-hours'),
            'sunday' => __('Sunday','neofonie-business-hours'),
        );
        return $days[$day];
    }
}