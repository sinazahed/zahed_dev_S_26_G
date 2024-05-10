<?php if(hasFlashData('LoginError')): ?> 
  <div class="alert alert-danger" role="alert">
    <?php echo hasFlashData('LoginError') ?>
  </div>
<?php endif; ?>