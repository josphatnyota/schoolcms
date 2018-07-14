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
        
        if(empty($this->_instance->select('students',['*'])->findAt(3))){
            
            $dn = $this->_instance->getColumns('students');
            $dn->adm_no = "Sasaa";
            $dn->name = "Caleb";
            $dn->class_id = 5;
            return $dn;
            
        }
        
        return $this->_instance->select('students',['*'])->findAt(3);
    }
}
