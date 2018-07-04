<?php

namespace App\Controllers;
use Core\Controller;

/**
 * Description of Dashboard
 * Created on : Jun 22, 2018, 2:22:27 PM
 * @author afrikannerd <https://github.com/afrikannerd>
 * @version "0.1"
 */
class DashboardController extends Controller{
    
    public function __construct($model) {
        
        parent::__construct($model);
        
    }
    
    public function index(){
        \Core\Security\Security::adminAreaAuth();
        if(\Core\Security\Sessions::auth()){
            $this->view->render('admin/index',$this->model->getTempData());
        }else{
            $this->view->render('admin/login');
        }
        
    }
    
    public function teachers(){
        
        $this->view->render('admin/teacherpanel');
        
    }
    public function students(){
        
        $this->view->render('admin/studentpanel');
        
    }
    
    public function fees(){
        
        $this->view->render('admin/feepanel');
    }
    
    public function exams(){
        
        $this->view->render('admin/exampanel');
    }

    public function __call($name, $arguments) {
        
        $this->view->render('admin/index');
        
    }

   

}
