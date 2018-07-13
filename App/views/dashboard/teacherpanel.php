<?php

/**
 * Description of teacherpanel
 * Created on : Jun 29, 2018, 12:25:06 PM
 * @author afrikannerd <https://github.com/afrikannerd>
 * @version "0.1"
 */

$this->setTitle('Admin | Teachers');
$this->open("head");

$this->close();
$this->open("body");
navigation();
sidebar();
?>
<div class="row offset main" id="main">
    <h3 class="page-header">Teachers</h3>
    <section class="content">
        <div class="row">
            <div class="container-fluid">
                <div class="btn-group ">
                    <button class="btn btn-primary" type="button" >Add New Teacher</button>
                    <button class="btn btn-primary" type="button" >View Teachers</button>
                    <button class="btn btn-danger" type="button" >Remove Teacher</button>
                </div>
            </div>
        </div>    
        
        
    </section>
</div>

<?php
$this->close();