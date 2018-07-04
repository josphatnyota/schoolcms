<?php

namespace Core;

/**
 * Description of Model
 *
 * @author afrikannerd <https://github.com/afrikannerd>
 * @version "0.1"
 */

abstract class Model {
    
    protected  $_instance = null;
    
    public function __construct() {
        
        $this->_instance = DB::instance();
        
    }
}
