<?php

namespace Core\Security;

/**
 * Description of Sessions
 * Created on : Jun 23, 2018, 9:54:56 AM
 * @author afrikannerd <https://github.com/afrikannerd>
 * @version "0.1"
 */
class Sessions {
    
    
    
    public function __construct() {
        ;
    }
    public static function auth(){
        
        if(!isset($_SESSION['auth'])){
            
            return false;
            
        }
        
        return true;
    }
    
    public static function setSession($index,$value){
        
        if(!isset($_SESSION[$index])){
            
            $_SESSION[$index] = $value;
            
            
        }
        
    }
    
    public static function unsetSession($key){
        
        if(isset($_SESSION[$key])){
            
            unset($_SESSION[$key]);
            return true;
        }
        return false;
    }
    
    public static function unsetAllSessions(){
        
        if (isset($_SESSION) && !empty($_SESSION)) {
            
            foreach ($_SESSION as $key => $value) {
                
                unset($_SESSION[$key]);
                
            }
            
            session_destroy();
            return true;
            
        }
        
        return false;
        
    }

    

}
