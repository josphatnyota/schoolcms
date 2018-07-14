<?php
namespace Core;
/**
 * Description of URLValidator
 * Created on : Jun 17, 2018, 4:52:58 PM
 * @author afrikannerd <https://github.com/afrikannerd>
 * @version "0.1"
 */
trait URLValidator {
    
    
    
    public function type($path):bool{
        
        return (bool)(strpos($path, '?')!== false || strpos($path, '=') !== false);
        
    }
    
    public function splitUrl($path , $bool):array{
        
        if($bool === true){
            
            return $this->splitQueryTypeUrl($path);
            
        }else{
            
            return $this->splitNormalUrl($path);
            
        }
        
    }
    
    private function splitQueryTypeUrl($path):array{
        
        $paths = [];
        $url = explode('?', $path, 2);
        $callables = [];
        
        if(strpos($url[0], "/") !== false){
            
            $callables = explode('/', $url[0]);
            
        }else{
            
            $callables[] = $url[0];
            $callables[] = ACTION;
            
        }
        
        $paths['callable'] = ['controller'=>CONTROLLER_NAMESPACE.ucfirst(strtolower($callables[0]))."Controller",'action'=>$callables[1]];
        
        $params = [];
        
        if(strpos($url[1], '&') !== false){
            
            $args = explode('&', $url[1]);
            
            foreach ($args as $param) {
                
                $param = explode('=', $param);
                $params[$param[0]] = $param[1]??"";
                
            }
            
        }elseif (strlen($url[1])  == 0) {
            
            return $paths;
            
        }else {
            
            $args = explode('=', $url[1]);
            $params[$args[0]] = $args[1]??"";
            
        }
        
        $paths['params'] = $params;
        
        return $paths;
        
    }
    
    private function splitNormalUrl($path){
        
        $paths = [];
        $path = rtrim($path, '/');
        $path = explode('/', $path);
        
        $paths['callable'] = ['controller'=>isset($path[0])?CONTROLLER_NAMESPACE.ucfirst(strtolower($path[0]))."Controller":CONTROLLER,'action'=>$path[1]??ACTION];
        
        if(isset($path[1])){
            
            array_shift($path);
            array_shift($path);
            
            if(isset($path)){
                
                $paths['params'] = array_values($path);
                
            }
            
        } 
        
        return $paths;
    }
   
    
}
