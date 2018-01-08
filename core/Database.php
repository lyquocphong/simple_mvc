<?php

namespace Core;

abstract class Database{
    
    public $connector = null;

    public function __construct($config)
    {
        $this->initConnector($config);
    }
    
    abstract public function initConnector($config);
}