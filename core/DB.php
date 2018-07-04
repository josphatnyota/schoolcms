<?php

namespace Core;
use PDO;
/**
 * Handles all Database interactions 
 *
 * @author afrikannerd <https://github.com/afrikannerd>
 * @version "0.1"
 */
final class DB {

    private static $_instance = null;
    
    private $_pdo, $_result = null, $_lastInsertID = 0, $_error = false,$_query,$_count = 0;

    private function __construct() {
        
        try {
            
            $ini = parse_ini_file("../helpers/settings.ini", true);
            $dsn = $ini['db']['driver'] . ':host=' . $ini['db']['host'] . ';dbname=' . $ini['db']['dbname'].';charset='.$ini['db']['charset'];
            $this->_pdo = new PDO($dsn, $ini['db']['user'], $ini['db']['pass'], $options = []);
            
        } catch (\PDOException $exc) {
            
            echo $exc->getMessage();
            
        }
        
    }

    /**
     * 
     * @return \self - a class instance
     */
    public static function instance(): self {
        
        if (self::$_instance == null) {
            
            self::$_instance = new DB();
            
        }
        
        return self::$_instance;
    }

    public function query($sql, $args = []) {
        
        $this->_error = false;
        
        if($this->_query = $this->_pdo->prepare($sql)){
            
            if (sizeof($args) > 0 ){
                
                $index = 1;
                
                foreach($args as $arg){
                    
                    $this->_query->bindValue($index, $arg);
                    $index++;
                    
                }
                
            }
            
        }
        
        if($this->_query->execute()){
            
            $this->results();
            $this->numRows();
            
        } else {
            
            $this->_error = true;
            
        }
         
        
        return $this;
    }

    public function insert($table, $args = []){
        
        $fields = "";
        $placeholders = "";
        $params = [];
        
        foreach ($args as $field => $data){
            
            $fields .= "`{$field}`,";
            $placeholders .= "?,";
            $params[] = $data;
            
        }
        
        $fields = rtrim($fields, ',');
        $placeholders = rtrim($placeholders, ',');
        $sql = "INSERT INTO {$table} ({$fields}) VALUES ({$placeholders})";
        
        $this->query($sql, $params);
    }

    public function select($table,$columns,$args = []){
        
        $fields = "";
        $placeholders = "";
        $params = [];
        
        foreach ($columns as $field){
            
            $fields .= "`{$field}`,";
            
        }
        
        $fields = rtrim($fields, ',');
        $sql = "SELECT {$fields} FROM {$table}";
        
        if(sizeof($args) > 0){
            
            foreach ($args as $key => $val){
                
                $placeholders .= "{$key}=? AND ";
                $params[] = $val;
                
            }
            
            $placeholders = rtrim($placeholders, "AND ");
            $sql .= " WHERE {$placeholders}";
            
        }
        
        return $this->query($sql, $params);
        
    }

    public function update($table,$args, $conditions) {
        
        $fields = "";
        $params = [];
        
        foreach ($args as $column => $value){
            
            $fields .= " {$column}=?,";
            $params[] = $value;
            
        }
        
        $fields = rtrim($fields, ',');
        
        foreach ($conditions as $key => $value) {
            
            $params[] = $value;
            $cond = $key."=?";
            break;
            
        }
        
        $sql = "UPDATE {$table} SET {$fields} WHERE {$cond}";
        
        $this->query($sql, $params);
    }
    /*
     * =========================================================================
     *              REMEMBER TO IMPLEMENT SOFT DELETE
     * =========================================================================
     */
    public function delete($table,$id){
        
        $condition;
        $params = [];
        
        foreach ($id as $key => $val){
            
            $condition = $key."=?";
            $params = $val;
            break;
            
        }
        
        $sql = "DELETE FROM {$table} WHERE {$condition}";
        
        $this->query($sql, $args);
    }
    
    public function getColumns($table){
        
        $sql = "SHOW COLUMNS FROM {$table}";
        
        return $this->query($sql);
    }

    public function findFirst() {
        
        return $this->_result[0];
            
        
        
    }

    public function findAt($key) {
        
        if(is_array($key)){
            
            $result = [];
            
            foreach ($key as $k) {
                
                if (array_key_exists($k, $this->_result)) {
                    
                    $result[] = $this->_result[$k];
                    
                }
                
            }
            
            return $result;
            
        }
        
        return $this->_result[$key]??[];
        
    }
    
    public function findLast(){
        
        return end($this->_result);
        
    }
   
    /*
     * =========================================================================
     *      INSTANCE VARIABLE  SETTER METHODS BEGIN HERE
     * =========================================================================
     */
    public function results():void{
        
        $this->_result = $this->_query->fetchAll(PDO::FETCH_OBJ);
        
    }
    
    public function numRows():void{
        
        $this->_count = $this->_query->rowCount();
       
    }
    
    public function lastInsertID():void{
        
        $this->_lastInsertID = $this->_pdo->lastInsertId();
        
    }
    /*
     * =========================================================================
     *      INSTANCE VARIABLE  GETTER METHODS START HERE
     * =========================================================================
     */
    public function getLastInsertID(){
        
        return $this->_lastInsertID;
        
    }
    
    public function getRowCount(){
        
        return $this->_count;
        
    }
    
    public function getResult(){
        
        return $this->_result;
        
    }

    public function __destruct() {
        
        $this->_pdo = null;
        
    }
    /*
     * =========================================================================
     *      THIS FOLLOWING SECTION ASSERTS THE SINGLETON PATTERN OF THIS CLASS
     *      BY MAKING SURE THE CLASS IS NOT CLONABLE.DO NOT MODIFY IF 
     *      UNSURE OF WHAT YOU'RE DOING
     * =========================================================================
     * 
     */
    private function __clone() {}

    public function __invoke() {}

    private function __wakeup() {}
    
}
