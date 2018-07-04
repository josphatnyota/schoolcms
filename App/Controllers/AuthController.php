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
   
    public function login() {
       
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
