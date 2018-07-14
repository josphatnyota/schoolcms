
<?php  $this->setTitle('Students');?>
<?php $this->open('head');?>
    <?php $this->close();?>
<?php $this->open('body');?>
    <img src="/assets/media/calb.jpg" height="200" width="200" />
    <div class="jumbotron">
        <h1 class="display-4">Hello, world!</h1>
        <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
        <hr class="my-4">
        <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
        <p class="lead">
          <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
        </p>
    </div>
    <input type="hidden" value="<?= Core\Security\Security::XSRFTokenGenerator()?>" />
    <?php $this->close();?>