<?php

namespace Core;

abstract class Controller{
    
    private $view;

    public function __construct()
    {
        $this->view = new View();
    }

    public function render($filename,$viewbag= array())
    {
        $this->view->render($filename,$viewbag);
    }

    public function return_json($value = array())
    {
        header('Content-type: application/json');
        echo json_encode($value);
        exit();
    }

}