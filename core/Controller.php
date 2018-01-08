<?php

/**
 * Base class for Controller
 */

namespace Core;

abstract class Controller{
    
    /**
     * View of controller
     */
    private $view;

    /**
     * Constructor
     * 
     * @return void
     */
    public function __construct()
    {
        $this->view = new View();
    }

    /**
     * Function to render view. This is wrapper for view->render function
     * 
     * @return void
     */
    public function render($filename,$viewbag= array())
    {
        $this->view->render($filename,$viewbag);
    }

    /**
     * Function to return as json type
     * 
     * @return void
     */
    public function return_json($value = array())
    {
        header('Content-type: application/json');
        echo json_encode($value);
        exit();
    }

}