<?php

namespace App\Models;

use Core\Model as CoreModel;
use \PDO;

class Email extends CoreModel{
    
    private $address = '';

    public function __construct()
    {
        parent::__construct();  
    }

    public function setAddress($address)
    {
        $this->address = filter_var ($address, FILTER_VALIDATE_EMAIL,FILTER_SANITIZE_SPECIAL_CHARS);
    }

    public function getAddress()
    {
        return $this->address;
    }

    public static function getAllEmail()
    {
        $ret = array();
        
        $sql = "SELECT * FROM email";

        $stmt = self::getDatabase()->connector->query($sql);

        if($stmt == false)
        {
            return $ret;
        }
        
        # setting the fetch mode
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        
        while($row = $stmt->fetch()) {
            $ret[$row['id']] = $row['address'];
        }

        return $ret;
    }

    public function save()
    {
            $address = $this->getAddress();      
            $stmt = self::getDatabase()->connector->prepare("INSERT INTO email (address) VALUES (:address)");
            $stmt->bindParam(':address', $address);
            $res = $stmt->execute();            

            if($res == true)
            {
                return true;
            }            
              
           return false;       
    }

}