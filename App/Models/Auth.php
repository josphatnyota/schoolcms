<?php

namespace App\Models;
use Core\Model;
/**
 * Description of Auth
 * Created on : Jun 29, 2018, 6:29:22 PM
 * @author afrikannerd <https://github.com/afrikannerd>
 * @version "0.1"
 */
class Auth extends Model{
    public function __construct() {
        parent::__construct();
    }
    
    public function login($username,$password){
        $this->_instance->select('');
    }
}
