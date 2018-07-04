<?php

/**
 * Description of subjectpanel
 * Created on : Jun 29, 2018, 12:25:38 PM
 * @author afrikannerd <https://github.com/afrikannerd>
 * @version "0.1"
 */

$this->setTitle('Admin | Subjects');
$this->open("head");

$this->close();
$this->open("body");
navigation();
sidebar();
?>
<div class="row offset main" id="main">
    <h3 class="page-header">Subjects</h3>
    <section class="content">
        <div class="row">
            <div class="container-fluid">
                <div class="btn-group ">
                    <button class="btn btn-primary" type="button" >Add Subject</button>
                    <button class="btn btn-primary" type="button" >View Subjects</button>
                    <button class="btn btn-danger" type="button" >Remove Subjects</button>
                </div>
            </div>
        </div>    
        
        
    </section>
</div>

<?php
$this->close();