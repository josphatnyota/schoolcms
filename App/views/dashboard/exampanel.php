<?php

/**
 * Description of exampanel
 * Created on : Jun 29, 2018, 12:26:14 PM
 * @author afrikannerd <https://github.com/afrikannerd>
 * @version "0.1"
 */

$this->setTitle("Exams Dashboard");
$this->open("head");
?>

<?php
$this->close();
$this->open("body");
navigation();
sidebar();
?>
<div class="row offset main" id="main">
    <h3 class="page-header">Exams</h3>
    <section class="content">
        <div class="row">
            <div class="container-fluid">
                <div class="btn-group ">
                    <button class="btn btn-primary" type="button" >Generate Results</button>
                    <button class="btn btn-primary" type="button" >View Results</button>
                    <button class="btn btn-danger" type="button" >Archive Results</button>
                </div>
            </div>
        </div>    
        
        
    </section>
</div>
<?php
$this->close();
