<?php

namespace Core\Security;

/**
 * Description of Security
 * Created on : Jun 21, 2018, 11:23:59 PM
 * @author afrikannerd <https://github.com/afrikannerd>
 * @version "0.1"
 */
class Security implements Securable {
    /**
     * 
     * @param type $path
     * @return bool
     */
    public static function pathIntegrityCheck($path):bool{
        
        $url = null;
        $allowed = ALLOWED_PATHS;
        
        if(strpos($path, "?") !== false){
            
            $url = explode('?', $path, 2);
            
        }else{
            
            $url = explode('/', $path, 2);
            
        }
        
        if(strpos($url[0], '/') !== false)
        {
            
            $url = explode('/', $url[0]);
            
        }
        
        if (preg_grep("/^$url[0]$/i", $allowed)){
            
            return true;
            
        }
        
        return false;
        
    }
    
    /**
     * 
     * @param type $token
     * @return bool
     */
    public static function XSRFProtection($token):bool{
        
        if($_SESSION['token'] === $token){
            
            return true;
            
        } else {
            
            return false;
            
        }
    }
    /**
     * 
     * @return string
     */
    public static function XSRFTokenGenerator($strlen = 10):string {
        
        return \hash('sha256', self::randomGenerator($strlen));
        
    }
    /**
     * 
     * @param type $length
     * @return string
     */
    public static function randomGenerator($length):string{
        
        $alphabet = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $token = '';
        $max = strlen($alphabet);
        
        for ($x = 0; $x < $length; $x++) {
            
            $token .= $alphabet[random_int(0, $max - 1)];
            
        }
        
        return $token;
    }

   public static function adminAreaAuth(){
       
       $authorized = false;
       
       $credentials = parse_ini_file("../helpers/settings.ini", true);
       $user = $_SERVER['PHP_AUTH_USER']??"";
       $pass = $_SERVER['PHP_AUTH_PW']??"";
       
       if($user === $credentials['admin']['user'] && $pass === $credentials['admin']['pass'] ){
           
           $authorized = true;
           
       }
       
       if (!$authorized){
           
           header("WWW-Authenticate: Basic realm = 'Dashboard'");
           header("HTTP/1.0 401 Unauthorized");
           (new \Core\View())->render("error401");
           die();
           
       }
       
   }

}
