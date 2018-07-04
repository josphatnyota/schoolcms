<?php

/**
 * Description of login
 * Created on : Jun 29, 2018, 2:49:00 PM
 * @author afrikannerd <https://github.com/afrikannerd>
 * @version "0.1"
 */

$this->setTitle("Admin | Login");
$this->open('head');
?>

<?php
$this->close();
$this->open('body');
?>
<form class="form admin-login col-md-offset-4" method="POST" action="auth/login">
    <fieldset>
        <legend>Admin Login</legend>
    <div class="form-group">
        <input type="text" name="username" class="form-control" placeholder="Username" />
    </div>
    <div class="form-group">
        <input type="password" name="password" class="form-control" placeholder="password" />
    </div>
   
        <input type="hidden"  name="criteria" value="0" />
     
    <div class="form-group">
        <input type="submit" role="button" class="btn btn-md btn-primary" value="Login" />
    </div>
        
    </fieldset>
</form>
<?php
$this->close();