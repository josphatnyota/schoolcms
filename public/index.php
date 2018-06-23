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



include_once '../helpers/config.php';


new \Core\Router();
