<?php

namespace Core;

/**
 * Description of DB
 *
 * @author afrikannerd <https://github.com/afrikannerd>
 * @version "0.1"
 */
final class DB {
    private static $_instance = null;
    private $_pdo,$_result = null,$_lastInsertID = 0,$_error = false;
    private function __construct() {
        try {
            $ini = parse_ini_file("../helpers/settings.ini",true);
            $dsn = $ini['db']['driver'].':host='.$ini['db']['host'].';dbname='.$ini['db']['dbname'];
            
            $this->_pdo = new \PDO($dsn, $ini['db']['user'], $ini['db']['pass'], $options = []);
            
        } catch (\PDOException $exc) {
            echo $exc->getMessage();
        }
    }
    /**
     * 
     * @return \self - a class instance
     */
    public static function instance(): self{
        if (self::$_instance == null){
            self::$_instance = new DB();
        }
        return self::$_instance;
    }
    
    public function query($sql,$args = []):self
    {
        
        return $this;
    }
    
    public function insert($table,$args = []):void
    {
        
    }
    
    public function select($table,$args = []):bool
    {
        
    }
    private function __clone() {
        return false;
    }
    
    public function __invoke() {
        
    }
    
    private function __wakeup() {
        return false;
    }
}
