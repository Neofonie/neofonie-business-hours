<?php 

namespace Neofonie\BusinessHours\Admin\Domain\Model;


class SimpleLocation implements ModelInterface{

    const SLUG = 'neofonie_location_';
    
    /**
     *  @var number
     */
    private $areaCode;
    /**
     *  @var number
     */
    private $phone;
    /**
     *  @var string 
     */
    private $email;
    /**
     *  @var string 
     */
    private $street;
    /**
     *  @var string      
     */
    private $number;
    /**
     *  @var string 
     */
    private $city;
    /**
     *  @var number      
     */
    private $zipCode;
    /**
     *  @var string 
     */
    private $country;
    /**
     *  @var string 
     */
    private $hint;
    /**
     *  @var string 
     */
    private $offer;
    /**
     *  @var string      
     */
    private $publicTransport;
    /**
     *  @var string 
     */
    private $googlePlace;
    /**
     *  @var Neofonie\BusinessHours\Admin\Domain\Model\TradingHourDays
     */
    private $tradingHourDays;


    public function __construct() {                
        $this->tradingHourDays = new TradingHourDays();    
    }

    public function loadByPostID($postID) {
        $loaderFunc = "loadByPostID"; 
        foreach ($this as $key => $value) {            
            if($this->$key instanceof ModelInterface) {                                               
               $this->$key->$loaderFunc($postID);                                                 
            } else {
                $this->$key = get_post_meta($postID,SimpleLocation::SLUG.$key,true);
            }            
        }          
    }

    public function loadsAndUpdatesByPostVars($postID) {   
        $updateFunc = "loadsAndUpdatesByPostVars";     
        foreach ($this as $key => $value) {  
            if($this->$key instanceof ModelInterface) {                
                $this->$key->$updateFunc($postID);     
            }else {
                $this->$key = isset($_POST[SimpleLocation::SLUG.$key]) ? sanitize_text_field($_POST[SimpleLocation::SLUG.$key]) : '';
                update_post_meta($postID, SimpleLocation::SLUG.$key, $this->$key);           
            }               
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
    
    public function getAreaCode(){
        return $this->areaCode;
    }

    public function getPhone(){
        return $this->phone;
    }

    public function getInternationalPhone(){
        $phone = str_replace([' ','(',')','+'],'',$this->phone);        
        if($this->areaCode) {               
            return $this->areaCode . substr($phone, 1 , strlen($phone));
        }
        return $phone;        
    }

    public function getEmail(){
        return $this->email;
    }
    
    public function getStreet(){
        return $this->street;
    }

    public function getNumber(){
        return $this->number;
    }

    public function getZipCode(){
        return $this->zipCode;
    }
    
    public function getCountry(){
        return $this->country;
    }

    public function getCity(){
        return $this->city;
    }

    public function getHint(){
        return $this->hint;
    }

    public function getOffer(){
        return $this->offer;
    }

    public function getPublicTransport(){
        return $this->publicTransport;
    }

    public function getGooglePlace(){
        return $this->googlePlace;
    }

    public function getTradingHourDays(){
        return $this->tradingHourDays;
    }
}