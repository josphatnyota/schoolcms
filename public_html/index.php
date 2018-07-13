<?php

/**
 * Description of index
 * Created on : Jun 16, 2018, 11:26:26 AM
 * @author afrikannerd <https://github.com/afrikannerd>
 * @version "0.1"
 */


include_once '../helpers/config.php';

(new Core\Router)->dispatch();


$t = Core\DB::instance();

$cols = [
    "id" => 123455,
    "name" => "calleb",
    "age" => 45,
];

$updatable = [
    "name",

];

#$t->insertUpdate("user_sessions",$cols,$updatable);
