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
    
    public $_pdo, $_result = null, $_lastInsertID = 0, $_error = false,$_query,$_count = 0;

    /**
     * DB constructor.
     */
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
        
        if (self::$_instance === null) {
            
            self::$_instance = new DB();
            
        }
        
        return self::$_instance;
    }

    /**
     * @param string $sql
     * @param array $args
     * @return $this
     */
    public function query(string $sql, array $args = []) {
        
        $this->_error = false;

        if($this->_query = $this->_pdo->prepare($sql)){
            
            if (sizeof($args) > 0 ){

                foreach($args as $key => $arg){


                    $this->_query->bindValue($key, $arg);

                }
                
            }
            
        }

        if($this->_query->execute()){
            
            $this->numRows();

            
        } else {
            
            $this->_error = true;
            
        }
         
        
        return $this;
    }

    /**
     * @param string $table
     * @param array $args
     */
    public function insert(string $table, array $args){
        
        $fields = "";
        $placeholders = "";
        $params = [];
        
        foreach ($args as $field => $data){
            
            $fields .= "`{$field}`,";
            $placeholders .= ":{$field},";
            $params[$field] = $data;
            
        }
        
        $fields = rtrim($fields, ',');
        $placeholders = rtrim($placeholders, ',');
        $sql = "INSERT INTO {$table} ({$fields}) VALUES ({$placeholders})";

        $this->query($sql, $params);
    }

    /**
     * @param string $table
     * @param array $columns
     * @param array $args
     * @return DB
     */
    public function select(string $table, array $columns, array $args = []){
        
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
                
                $placeholders .= " {$key}=:{$key} AND";
                $params[$key] = $val;
                
            }
            
            $placeholders = rtrim($placeholders, "AND");
            $sql .= " WHERE {$placeholders}";
            
        }

        return $this->query($sql, $params);
        
    }



    /**
     * @param string $table
     * @param array $args
     * @param array $conditions
     */
    public function update(string $table, array $args, array $conditions) {
        
        $fields = "";
        $params = [];
        
        foreach ($args as $column => $value){
            
            $fields .= " {$column}=:{$column},";
            $params[$column] = $value;
            
        }
        
        $fields = rtrim($fields, ',');
        
        foreach ($conditions as $key => $value) {
            
            $params[$key] = $value;
            $cond = $key."=:{$key}";
            break;
            
        }
        
        $sql = "UPDATE {$table} SET {$fields} WHERE {$cond}";

        $this->query($sql, $params);
    }

    /**
     * @param $table
     * @param array $cols
     * @param array $updatable
     */
    public function insertUpdate(string $table, array $cols, array $updatable)
    {
        $fields = "";
        $values = "";
        $updates = "";
        $params = [];
        $sql = "INSERT INTO {$table} (";

        foreach ($cols as $key => $col) {

            $fields .= "`{$key}`,";
            $values .= ":{$key},";
            $params[$key] = $col;

        }

        $fields = rtrim($fields,',');
        $values = rtrim($values,',');
        $sql .= "{$fields}) VALUES ({$values})";

        foreach ($updatable as $col){

            $updates .= "`{$col}`=:{$col},";

        }

        $updates = rtrim($updates,',');
        $sql .= " ON DUPLICATE KEY UPDATE  {$updates}";

        $this->query($sql,$params);

    }
    /*
     * =========================================================================
     *              REMEMBER TO IMPLEMENT SOFT DELETE
     * =========================================================================
     */

    /**
     * Performs delete operations(soft or hard)
     * @param string $table table from which a row is to be deleted
     * @param array $id <p>an associative key=>value array of the row identifiers
     * for the row to be deleted</p>
     * @param bool $flag Determines if its a soft delete or hard delete<p>
     * When set to true,The function executes soft delete by togggling the
     * enum value of the delete column of the current table.
     * </p>
     */
    public function delete(string $table, array $id, bool $flag = false,string $operator = '='){


        $condition = "";
        $params = [];
        
        foreach ($id as $key => $val){


            $condition = $key."{$operator}:{$key}";
            $params[$key] = $val;
            break;
            
        }
        if($flag){

            $this->update($table,["deleted" => 1],$id);

            return;

        }else{

            $sql = "DELETE FROM {$table} WHERE {$condition}";

        }


        $this->query($sql, $params);
    }

    /**
     * @param $table
     * @return DB
     */
    public function getColumns(string $table){
        
        $sql = "SHOW COLUMNS FROM {$table}";
        
        return $this->query($sql);
    }

    /**
     * @return mixed
     */
    public function findFirst() {
        
        return $this->_result[0];
            
        
        
    }

    /**
     * @param $key
     * @return array
     */
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

    /**
     * @return mixed
     */
    public function findLast(){
        
        return end($this->_result);
        
    }
   
    /*
     * =========================================================================
     *      INSTANCE VARIABLE  SETTER METHODS BEGIN HERE
     * =========================================================================
     */
    /**Returns query result in specified format
     * @param int $mode PDO constants PDO::FETCH_*. if not supplied PDO::FETCH_OBJ is used as default
     * @return array
     */
    public function results(int $mode = PDO::FETCH_OBJ){
        
        $this->_result = $this->_query->fetch($mode);


    }



    /**
     *
     */
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
    /**
     * @return int
     */
    public function getLastInsertID(){
        
        return $this->_lastInsertID;
        
    }

    /**
     * @return int
     */
    public function getRowCount(){
        
        return $this->_count;
        
    }

    /**
     * @return array
     */
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
