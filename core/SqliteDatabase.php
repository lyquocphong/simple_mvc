<?php

namespace Core;

use \PDO;

class SqliteDatabase extends Database{
    
    public function initConnector($config){                
        $this->connector = new PDO('sqlite:'.$config['connection_string']);        
    }

}