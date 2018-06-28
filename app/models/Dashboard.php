<?php

namespace App\Models;
use Core\Model;
/**
 * Description of Dashboard
 * Created on : Jun 22, 2018, 4:40:00 PM
 * @author afrikannerd <https://github.com/afrikannerd>
 * @version "0.1"
 */
class Dashboard extends Model{
    
    public function __construct() {
        parent::__construct();
    }
    public  function getTempData() {
        
        return $this->_instance->select('temp',['*'])->findAt(1);
        
    }
}
