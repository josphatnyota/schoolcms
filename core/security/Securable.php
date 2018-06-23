<?php

namespace Core\Security;

/**
 * Description of Securable
 * Created on : Jun 21, 2018, 11:29:43 PM
 * @author afrikannerd <https://github.com/afrikannerd>
 * @version "0.1"
 */
interface Securable {
    public static function pathIntegrityCheck($path):bool;
    public static function XSRFProtection($token):bool;
    public static function XSRFTokenGenerator():string;
}
