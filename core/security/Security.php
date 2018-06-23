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
        /*$basePath = ROOT;
        $realBase = realpath($basePath);
        $clientPath = $realBase.$path;
        $realClientPath = realpath($clientPath);
        if($realClientPath === false || strcasecmp($realClientPath, $realBase)
                !== 0 || strpos($realClientPath, $realBase) !==0){
            /*
             * ====================================================
             *           404 handler here
             * ====================================================
             *
            return false;
            
        }
         * 
         */
        $url = explode('/', $path, 2);
        $allowed = ALLOWED_PATHS;
        
        if (preg_grep("/$url[0]/i", $allowed)){
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
    public static function XSRFTokenGenerator():string {
        return \hash('sha256', self::randomGenegator(13));
    }
    /**
     * 
     * @param type $length
     * @return string
     */
    public static function randomGenegator($length):string{
        $alphabet = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $token = '';
        $max = strlen($alphabet);
        for ($x = 0; $x < $length; $x++) {
            $token .= $alphabet[random_int(0, $max - 1)];
        }
        
        return $token;
    }

   

}
