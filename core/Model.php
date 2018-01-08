<?php

namespace Core;

abstract class Model{
    
    private static $database;

    private static $_instance; 

	public static function getDatabase() {
		if(!self::$database) { // If no instance then make one
			self::initDatabase();
        }
        
		return self::$database;
	}

    public function __construct()
    {
        self::initDatabase();
    }    

    private static function initDatabase()
    {
        $default_db_driver = Application::$instance->config['db']['default_driver'];

        if(isset(Application::$instance->config['db'][$default_db_driver]) == false)
        {
            exit('can not initialize database connection, config is missing');
        }

        $config = Application::$instance->config['db'][$default_db_driver];

        $class_name = 'Core\\'.(Application::$instance->config['db']['class_map'][$default_db_driver]);
        
        self::$database = new $class_name($config);
    }
}