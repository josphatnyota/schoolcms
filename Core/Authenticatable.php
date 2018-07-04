<?php

namespace Core;

/**
 * Description of Authenticatable
 * Created on : Jun 29, 2018, 6:21:39 PM
 * @author afrikannerd <https://github.com/afrikannerd>
 * @version "0.1"
 */
interface Authenticatable {
    public function login();
    
    public function register();
    
    public function resetPassword();
    
    public function logout();
}
