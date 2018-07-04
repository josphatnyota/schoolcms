
<?php

session_start;

require_once 'helpers/config.php';
require_once 'helpers/functions.php';

$url_parts = isset($_SERVER['PATH_INFO']) ? explode('/' , ltrim($_SERVER['PATH_INFO'] , '/')) : [];

Router::route($url_parts);



