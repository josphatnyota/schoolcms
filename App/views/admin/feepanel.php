<?php

/**
 * Description of feepanel
 * Created on : Jun 29, 2018, 12:24:07 PM
 * @author afrikannerd <https://github.com/afrikannerd>
 * @version "0.1"
 */
$this->setTitle('Admin | Fees');
$this->open("head");

$this->close();
$this->open("body");
navigation();
sidebar();
?>
<div class="row offset main" id="main">
    <h3 class="page-header">Students</h3>
    <section class="content">
        <div class="row">
            <div class="container-fluid">
                <div class="btn-group ">
                    <button class="btn btn-primary" type="button" >Update Fees</button>
                    <button class="btn btn-primary" type="button" >Students With Arreas</button>
                    <button class="btn btn-primary" type="button" >Set Fees</button>
                </div>
            </div>
        </div>    
        
        
    </section>
</div>

<?php
$this->close();
