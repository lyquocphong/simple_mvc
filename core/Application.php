<?php

namespace Core;

class Application{
    
    private $action = null;

    private $original_url = null;

    public $config = array();

    public static $instance = null;

    public function __construct($url,$config)
    {
        static::$instance = $this;

        $this->initConfig($config);

        $url = rtrim($url,'/');
        $this->original_url = $url;       
        $this->dispatchUrl($url);        
    }

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

    public function makeUrl($path)
    {
        return $this->getBaseUrl().$path;
    }

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

    private function initConfig($config)
    {
        $this->config = array_replace_recursive($this->getDefaultConfig(),$config);
    }

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

    public function getInput()
    {
        //if(isset())
    }
}