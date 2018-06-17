<?php

/**
 * Description of config
 * Handles all site primary configurations such as paths
 * Created on : Jun 16, 2018, 10:44:26 AM
 * @author afrikannerd <https://github.com/afrikannerd>
 * @version "0.1"
 */
ini_set("display_errors", 1);
/**
 * Define directory separator
 */
define("DS", "/");    

/**
 * 
 * @return app root path
 * used when this file is not in the root directory.
 * if file is n indices deep into the directory,return path[n]
 * if file in root directory,replace the function call with plain dirname(__FILE__)
 */
function root(){
    $path = strrev(dirname(__FILE__));
    $path = explode(DIRECTORY_SEPARATOR, $path);
    
    return strrev(DS.$path[1].DS);
}

/**
 * defining the root directory
 * 
 */
 define("ROOT", root());


/*
 * Define paths to directories
 */
 if(version_compare(PHP_VERSION, "7.0.0", "<")){
     
 }else{
   define("core", "../core/");
   define("app", [
    "con" => "../app/controllers/",
    "mod" => "../app/models/",
    "view" => "../app/views/",
   ]);  
 }
 /*
define("core", "../core/");
define("app", [
    "con" => "../app/controllers/",
    "mod" => "../app/models/",
    "view" => "../app/views/",
]); 
  * 
  */
/*
 * Call the autoloader
 */

include_once 'autoloader.php';
/*
 * Loading site helper functions
 */
include_once 'functions.php';