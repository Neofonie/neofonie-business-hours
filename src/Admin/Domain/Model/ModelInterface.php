<?php 

namespace Neofonie\BusinessHours\Admin\Domain\Model;

/**
 * Defines a common set of functions that any class responsible for loading and saving their data
 */
interface ModelInterface {
 
    public function loadByPostID($postID);    
    public function loadsAndUpdatesByPostVars($postID);
    public function getAllProperties();
    public function __get($property);
     
}