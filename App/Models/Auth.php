<?php

namespace App\Models;
use \Core\Model;
use \Core\Security\Session;
/**
 * Description of Auth
 * Created on : Jun 29, 2018, 6:29:22 PM
 * @author afrikannerd <https://github.com/afrikannerd>
 * @version "0.1"
 */

class Auth extends Model{

    private $_table = "users";
    public $isLoggedIn = false;
    public $data = [];
    public $errors = [];


    public function __construct() {
        parent::__construct();

    }
    
    public function login(array $columns,array $creds){

        try{
            if($result = $this->_instance->select($this->_table,$columns,$creds))
            {



                if ($result->getRowCount() > 0){
                    $this->data = $result->findFirst();
                    #dnd($this->data);
                    $this->isLoggedIn = true;
                }



            }else{
                $this->errors [] = "no users found";
            }


        }catch (\PDOException $e)
        {
            $this->isLoggedIn = false;
            throw $e;
        }
        return $this;
    }



    public function isLoggedIn()
    {
        return $this->isLoggedIn;
    }

}
