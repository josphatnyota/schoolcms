<?php $this->setTitle('404');?>
<?php $this->open('head');?>

<?php $this->close(); ?>
<?php $this->open('body');?>
<div class="error404">
    <img src="/assets/media/sunshine.jpg" alt="Sunshine logo" height="150" width="150"/>
    <h1><strong>That's a 404</strong></h1>
    <p><?= $_SERVER['REQUEST_URI'];?> not found.</p>
</div>
<?php $this->close(); ?>