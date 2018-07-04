<?php

namespace App\Controllers;
use Core\Controller;
/**
 * Description of HomeController
 * Created on : Jun 16, 2018, 4:10:01 PM
 * @author afrikannerd <https://github.com/afrikannerd>
 * @version "0.1"
 */
class HomeController extends Controller {
    //put your code here
    public function __construct($model) {
        parent::__construct($model);
    }
    public function index(){
        
        $this->view->render('home/index');
        
    }
    public function another(){
        
        $this->view->render('student/index');
        
    }
    
    public function __call($name, $arguments) {
        
        $bad_uri = $_SERVER['REQUEST_URI'];
        $this->view->render('error404');
    }
}
