<?php

namespace Core;

/**
 * Description of App
 *
 * @author afrikannerd <https://github.com/afrikannerd>
 * @version "0.1"
 */
class App {
    /**
     * prints out the directory
     * 
     */
    public function __construct() {
        echo dirname(dirname(__DIR__));
    }
}
