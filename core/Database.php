<?php

/**
 * Base class for Database
 */
namespace Core;

abstract class Database{
    
    /**
     * Database connector
     */
    public $connector = null;

    /**
     * Constructor
     * 
     * @return void
     */
    public function __construct($config)
    {
        $this->initConnector($config);
    }
    
    /**
     * Abstract function to init database connector
     * 
     * @return void
     */
    abstract public function initConnector($config);
}