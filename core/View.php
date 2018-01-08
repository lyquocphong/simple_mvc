<?php

namespace Core;

class View{   

    private $js_files = array();
    private $css_files = array();

    private $layout_path = '';

    public function __construct()
    {
        $this->layout_path = Application::$instance->config['app']['layout_path'];
        $this->base_url = Application::$instance->getBaseUrl();
    }

    public function render($filename,$viewbag = array())
    {
        foreach($viewbag as $key => $value)
        {
            $this->$key = $value;
        }
        
        ob_start();
        require Application::$instance->config['app']['view_path'].'/'.$filename.'.php';
        $content = ob_get_clean();
        
        $header = $this->renderHeader();        
        $footer = $this->renderFooter();

        echo $header.$content.$footer;
    }

    public function addJS($key,$file_path,$force_replace = false)
    {
        if(empty($this->js_files[$key]) == false && $force_replace == false)
        {
            return;
        }
        
        $this->js_files[$key] = $file_path;
    }

    public function addCSS($key,$file_path,$force_replace = false)
    {
        if(empty($this->css_files[$key]) == false && $force_replace == false)
        {
            return;
        }
        
        $this->css_files[$key] = $file_path;
    }

    private function renderHeader()
    {
        ob_start();
        require_once $this->layout_path.'/header.php';
        $header = ob_get_clean();

        return $header;
    }

    private function renderFooter()
    {
        ob_start();
        require_once $this->layout_path.'/footer.php';
        $footer = ob_get_clean();

        return $footer;
    }

    private function renderCSSFiles()
    {
        $ret = '';

        foreach($this->css_files as $file)
        {
            $ret .= '<link rel="stylesheet" type="text/css" href="'.$file.'" />';
        }

        echo $ret;
    }

    private function renderJSFiles()
    {
        $ret = '';

        foreach($this->js_files as $file)
        {
            $ret .= '<script src="'.$file.'"></script>';
        }

        echo $ret;
    }
}