<?php

namespace App\Controllers;
use Core\{
    Controller,
    Authenticatable,
    Security\Session,
    Security\Security,
};


/**
 * Description of AuthController
 * Created on : Jun 29, 2018, 6:26:05 PM
 * @author afrikannerd <https://github.com/afrikannerd>
 * @version "0.1"
 */
class AuthController extends Controller implements Authenticatable {
    private $_creds = [],$_isLoggedIn = false,$_columns = [],$_level = null,$_data = null,$_session;

   public function __construct($model)
   {
       parent::__construct($model);
       Session::init();
       if(Session::exists('auth'))
       {
           header("Location: /dashboard");
       }
   }

    public function login() {
        Security::adminAreaAuth();
        $this->view->render('dashboard/login');

        if(isset($_POST['login']))
        {
            $this->_creds['id'] = $_POST['user'];
            $this->_creds['users_password'] = $_POST['pass'];
            $this->_creds['users_rank'] = $_POST['level'];
            $this->_columns = ['*'];

            $obj  =  $this->model->login($this->_columns,$this->_creds);
            $this->_data = $obj->data;
            $this->_isLoggedIn = $obj->isLoggedIn();



                if ($this->_isLoggedIn) {



                    Session::set(['auth'=>true,'user_id'=>$this->_data->id,'user_name'=>$this->_data->users_name,'level'=>$this->_data->users_rank]);

                    header("location: /dashboard");

                }else{
                    redirect('auth/login')->error(['error'=>"Wrong credentials"]);
                }
            }


        #return false;
        
    }

    public function register() {
        
        
        
    }

    public function resetPassword() {
        
        
        
    }
    
    public function logout(){
        
        Sessions::unsetAllSessions();
        
    }

}
