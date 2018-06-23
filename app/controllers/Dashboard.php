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
    public function __call($name, $arguments) {}
}
