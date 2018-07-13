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
    die();
    
}

function contains($haystack, $needle) {
    
    return strpos($haystack, $needle) !== false;
    
}

function navigation(){
    echo <<<NAV
<nav class="navbar navbar-default navbar-fixed-top custom-navbar">
    <div class="container-fluid">
        <div class="">
            <form class="navbar-form navbar-left" role="search">
                <div class="form-group">
                  <input type="text" class="form-control custom-search" placeholder="Search">
                </div>
                
            </form>
        </div>
        <div class="right pull-right">

        </div>
    </div>
    
</nav>
NAV;
}

function sidebar(){
    echo <<<EOT
<div class=" col-md-2 custom-sidebar">
    <ul class="list-group">
        <a href="/dashboard" class="list-group-item">Home</a>
        <a href="/dashboard/students" class="list-group-item">Students</a>
        <a href="/dashboard/teachers" class="list-group-item">Teachers</a>
        <a href="/dashboard/fees" class="list-group-item">Fees</a>
        <a href="/dashboard/exams" class="list-group-item">Exams</a>
    </ul>
</div>
EOT;
}


function redirect($path)
{
    return new class($path)
    {
        private $_path = null,$_data = [];
        public function __construct(string $path)
        {
            $this->_path = $path;

        }

        public function with(object $data)
        {
            $this->_data = $data;
        }

        public function error(array $error)
        {
            $this->_data = $error;
        }

        private function redirect()
        {

            (new \Core\View)->render($this->_path,$this->_data);

        }

        public function __destruct()
        {
            $this->redirect();
        }

    };
}