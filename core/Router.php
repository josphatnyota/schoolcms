<?php

namespace Core;

/**
 * Description of Router
 * Created on : Jun 17, 2018, 1:01:01 AM
 * @author afrikannerd <https://github.com/afrikannerd>
 * @version "0.1"
 */
class Router {
    
    private $_controller = CONTROLLER;
    private $_action = ACTION;
    private $_params = [];
    public function __construct($url) {
        $this->route($url);
    }
    private function route($url){
        if (!empty($url)){
        if (file_exists('\App\Controllers\\'.ucfirst(strtolower($url[0])).'.php')){
            $this->_controller = $controller = '\App\Controllers\\'.ucfirst(strtolower($url[0]));
            array_shift($url);
        }
        
        if (method_exists($this->_controller, $url[0])) {
            $this->_action = $url[0];
            array_shift($url);
        }
        
        $this->_params = isset($url) ? array_values($url) : [];
        }
        $obj = new $this->_controller();
        call_user_func_array([$obj, $this->_action], $this->_params);
    }
}
