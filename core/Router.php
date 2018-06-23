<?php

namespace Core;
use Core\Security\Security;
/**
 * Description of Router
 * Created on : Jun 17, 2018, 1:01:01 AM
 * @author afrikannerd <https://github.com/afrikannerd>
 * @version "0.1"
 */
final class Router {
    private $routes = [
        'callable' => [
            'controller' => CONTROLLER,
            'action' => ACTION
        ],
        'params' => []
    ];
    
    
    /*
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
     * 
     */
    
    use URLValidator;
    public function __construct() {
        $this->parseUrl();
        $this->dispatch();
    }
    public function add($route):void{
        $this->routes[] = $route;
    }
    
    public function parseUrl(){
        $url = urldecode($_SERVER['REQUEST_URI']);
        $url = ltrim($url, '/');
        $url = preg_replace('/\?(?!.*[a-zA-Z0-9])|\/(?!.*[a-zA-Z0-9])/','', $url);
        if(Security::pathIntegrityCheck($url)){
            if($this->type($url)){
                $this->routes = $this->splitUrl($url, true);
            }else{
                $this->routes = $this->splitUrl($url, false);
            }
        }else{
            return false;
        }
        
        return $this->routes;
    }
    
    public function dispatch(){
        $model = '';
        $controller = $model = $this->routes['callable']['controller'];
        $action     = $this->routes['callable']['action'];
        $params     = $this->routes['params']??[];
        
        
        if(!class_exists($controller)){
            $controller = $model = CONTROLLER;
        }
        
        $obj = new $controller($model);
        
        call_user_func([$obj,$action], $params);
        
    }
    
    public function __call($name, $arguments) {}
    
}
