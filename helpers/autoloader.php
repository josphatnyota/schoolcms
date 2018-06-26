<?php

/**
 * Description of autoloader
 * Dynamically loads php class files on demand
 * Created on : Jun 16, 2018, 9:56:01 AM
 * @author afrikannerd <https://github.com/afrikannerd>
 * @version "0.1"
 */

spl_autoload_register(function($class)
{
    $with_nmsp = explode("\\", $class);
    
    if ( count($with_nmsp) > 1)
    {
        
        $class = implode('/', $with_nmsp);
        
        if ( file_exists( '../'.$class.'.php' ) ){
            
            include_once '../'.$class.'.php';
            
        }
        
        return;
        
    }
    
}
);