<?php

namespace Core;
use Core\{
    Security\Security as Security, Security\MySQLSessionHandler
};

/**
 * Description of Router
 * Created on : Jun 17, 2018, 1:01:01 AM
 * @author afrikannerd <https://github.com/afrikannerd>
 * @version "0.1"
 */
final class Router {
    
    private $routes;
    
    use URLValidator;
    
    public function __construct() {

        $this->parseUrl();
            

    }
    
    
    private function parseUrl(){
        
        $url = preg_replace('/\s+/','',urldecode($_SERVER['REQUEST_URI']));
        $url = ltrim($url, '/');
        $url = preg_replace('/\?(?!.*[a-zA-Z0-9])|\/(?!.*[a-zA-Z0-9])/','', $url);
        $url = str_replace("/?", "?", $url);
        
        if(empty($url)||!preg_grep('/^[a-z]/i', [$url])){
            
            $url = CONTROLLER_NAME.$url;
            
        }
        
        if(Security::pathIntegrityCheck($url)){
            
            if($this->type($url)){
                
                $this->routes = $this->splitUrl($url, true);
                
            }else{
                
                $this->routes = $this->splitUrl($url, false);
                
            }
            
        }else{
            
            return new class(){
                
                public function __construct(){

                    (new View())->render('error404');

                }
            };
       
        }
        
        return true;
    }
    
    public function dispatch(){
        
        $model = '';
        $controller = $model = isset($this->routes['callable']['controller']) ? $this->routes['callable']['controller'] : CONTROLLER;
        $action     = $this->routes['callable']['action'];
        $params     = $this->routes['params']??[];
        #dnd($this->routes);
        if(!class_exists($controller)){
            
            return new class(){

                public function __construct(){

                    (new View())->render('error404');

                }
            
            };
            
        }
        
        $obj = new $controller($model);
        //maybe
        call_user_func_array([$obj,$action], $params);
        
    }
    
    public function __call($name, $arguments) {}


}
