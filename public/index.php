<?php

/**
 * Description of index
 * Created on : Jun 16, 2018, 11:26:26 AM
 * @author afrikannerd <https://github.com/afrikannerd>
 * @version "0.1"
 */

/**
 * start session
 */
session_start();
/**
 * get url to process for redirects
 */

error_reporting(E_ALL);

/*
 * disintegrating url into an array of parts
 */

$parts = isset($_SERVER['PATH_INFO']) ? explode("/", ltrim( $_SERVER['PATH_INFO'],"/")) : [];

include_once '../helpers/config.php';
#(new \Core\View)->render("home/index");
new \Core\Router($parts);


