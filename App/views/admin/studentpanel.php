<?php

/**
 * Description of studentpanel
 * Created on : Jun 29, 2018, 12:20:30 PM
 * @author afrikannerd <https://github.com/afrikannerd>
 * @version "0.1"
 */

$this->setTitle('Admin | Students');
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
                    <button class="btn btn-primary" type="button" >Add New Student</button>
                    <button class="btn btn-primary" type="button" >View Students</button>
                    <button class="btn btn-danger" type="button" >Remove Student</button>
                </div>
            </div>
        </div>    
        
        
    </section>
</div>

<?php
$this->close();