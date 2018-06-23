<?php

namespace Core;

/**
 * Description of Controller
 *
 * @author afrikannerd <https://github.com/afrikannerd>
 * @version "0.1"
 */
abstract class Controller {
    
    protected $model = MODEL;
    public $view;
    
    public function __construct($model) {
        
        $this->view = new View();
        
    }
    
    protected function model($model){
        
        $this->model = str_replace(CONTROLLER_NAMESPACE, MODEL_NAMESPACE, $model);
        
        return new $this->model();
        
    }
    
}
