<?php

/**
 * This is base class for Application
 */

namespace Core;

class Application{
    
    /**
     * Config value
     */
    public $config = array();

    /**
     * Instance of application
     */
    public static $instance = null;

    /**
     * Constructor
     * 
     * @return void
     */
    public function __construct($url,$config)
    {
        static::$instance = $this;

        $this->initConfig($config);

        $url = rtrim($url,'/');
        $this->original_url = $url;       
        $this->dispatchUrl($url);        
    }

    /**
     * Get defaut config for application
     * 
     * @return array
     */
    private function getDefaultConfig()
    {
        $default = array(
            "app" => array(
                'view_path' => 'app/views',
                'default_controller' => 'main',
                'default_controller_action' => 'index'                
            ),
            "db" => array(
                'default_driver' => 'mysqli',
                'class_map' => array(
                    'sqlite' => 'SqliteDatabase'
                )
            )
        );

        return $default;
    }    

    /**
     * Some kind of helper to make url
     * 
     * @return string
     */
    public function makeUrl($path)
    {
        return $this->getBaseUrl().$path;
    }

    /**
     * Get application base url
     * 
     * @return string
     */
    public function getBaseUrl() 
    {
        // output: /myproject/index.php
        $currentPath = $_SERVER['PHP_SELF']; 
        
        // output: Array ( [dirname] => /myproject [basename] => index.php [extension] => php [filename] => index ) 
        $pathInfo = pathinfo($currentPath); 
        
        // output: localhost
        $hostName = $_SERVER['HTTP_HOST']; 
        
        // output: http://
        $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https://'?'https://':'http://';
        
        // return: http://localhost/myproject/
        return $protocol.$hostName.$pathInfo['dirname']."/";
    }

    /**
     * Init config for application
     * 
     * @return void
     */
    private function initConfig($config)
    {
        $this->config = array_replace_recursive($this->getDefaultConfig(),$config);
    }

    /**
     * Dispatch url to handle
     * 
     * @return void
     */
    private function dispatchUrl($url)
    {
        $paths = explode('/',$url);

        $controller_name = array_shift($paths);

        if(empty($controller_name) == true)
        {
            $controller_name = $this->config['app']['default_controller'];
        }
        
        $controller_class = 'App\\Controllers\\'.ucfirst($controller_name).'Controller';
        
        try
        {
            $this->controller = new $controller_class();
        }
        catch(Exception $e)
        {
            die('Controller not exist');
        }        

        $function_name = array_shift($paths);        

        if(empty($function_name) == true)
        {
            $function_name = $this->config['app']['default_controller_action'];
        }

        if(empty($paths) == true)
        {
            $paths = array();
        }
        
        if(is_callable(array($this->controller, $function_name)) == false)
        {
            die('Function is not avaiables');
        }

        call_user_func_array(array($this->controller, $function_name), $paths);
    }
}