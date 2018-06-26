<?php

namespace App\Controllers;
use Core\Controller;
/**
 * Description of Dashboard
 * Created on : Jun 22, 2018, 2:22:27 PM
 * @author afrikannerd <https://github.com/afrikannerd>
 * @version "0.1"
 */
class Dashboard extends Controller {
    
    public function __construct($model) {
        
        parent::__construct($model);
        
    }
    
    public function index(){
        
        $this->view->render('admin/index');
        
    }
    
    public function teachers(){
        $this->view->render('error401');
    }
    public function __call($name, $arguments) {
        //$cont = $cont_name =  CONTROLLER_NAMESPACE.ucfirst(strtolower($name)).'.php';
        //$obj = new $cont($cont_name);
        $this->view->render('admin/index');
        //call_user_func([$obj,$cont_name], $arguments);
    }
}
