<?php

namespace App\Controllers;
use Core\Controller;
use Core\Authenticatable;
use Core\Security\Sessions;
/**
 * Description of AuthController
 * Created on : Jun 29, 2018, 6:26:05 PM
 * @author afrikannerd <https://github.com/afrikannerd>
 * @version "0.1"
 */
class AuthController extends Controller implements Authenticatable {
   /**
    *
    * @var $_table 
    */    
    private $_table = ['admin','teachers','students'];
    public function login() {
        dnd($_POST);
        $creds = [];
        if(isset($_POST)){
            foreach ($_POST as $key => $value) {
                if($key === "criteria"){
                    $creds['table'] = $this->_table[$key];
                    continue;
                }
                $creds[$key] = $value;
            }
            
            dnd($creds);
            
        }
        
        
        $this->model->login();
    }

    public function register() {
        
    }

    public function resetPassword() {
        
    }
    
    public function logout(){
        Sessions::unsetAllSessions();
    }

}
