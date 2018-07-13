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
    protected $middleware;


    public function __construct($model) {

        $model = str_replace(CONTROLLER_NAMESPACE, MODEL_NAMESPACE, $model);
        $model = str_replace("Controller", "" , $model);
        $this->view = new View();
        $this->model = new $model();

    }
    

    
}
