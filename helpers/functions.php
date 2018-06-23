<?php

/**
 * Description of functions
 * Created on : Jun 17, 2018, 10:14:09 AM
 * @author afrikannerd <https://github.com/afrikannerd>
 * @version "0.1"
 */
function dnd($arr) {
    echo "<pre>";
    var_dump($arr);
    echo "</pre>";
}

function contains($haystack, $needle) {
    return strpos($haystack, $needle) !== false;
}
