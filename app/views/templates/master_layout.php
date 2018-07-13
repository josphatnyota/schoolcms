
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?= $this->title();?></title>
       
    
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/css/app.css" rel="stylesheet" type="text/css"/>
        <?=  $this->head(); ?>
    </head>
    <body>
        <div class="container-fluid">
            <?php

            if(count($this->_errors) > 0){
                foreach($this->_errors as $error){
            ?>
            <div class="alert alert-warning">
                <?= $error;?>
            </div>
            <?php
                }
            }
            ?>
            <?= $this->body();?>
        </div>
        
        
    </body>
</html>
