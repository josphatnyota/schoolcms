<?php
/**
 * Created by PhpStorm.
 * User: nerd
 * Date: 10/07/2018
 * Time: 13:27
 */

namespace Core\Security;



class Session
{

    public static function init()
    {

        new MySQLSessionHandler();
        session_start();
    }

    public  static function get($key)
    {
        if(self::exists($key))
        {
            return $_SESSION[htmlentities($key)];
        }
        return false;
    }

    public  static function set(array $keyValuePair):void
    {
        foreach ($keyValuePair as $key => $value) {
            if(!self::exists($key))
            {
                $_SESSION[htmlentities($key)] = htmlentities($value);
            }
        }


    }

    public  static function exists($key):bool
    {

        return (bool)isset($_SESSION[htmlentities($key)]);

    }

    public  static function kill($key):void
    {
        if (self::exists($key)){
            unset($_SESSION[$key]);
        }
    }

    public  static function killAll():void
    {
        if(isset($_SESSION)){
            unset($_SESSION);
            session_destroy();
        }
    }

    public static function status()
    {
        return session_status();
    }

    public static function getAll()
    {
        return $_SESSION;
    }

    public function __destruct()
    {

    }
}

