<?php if(count($errors) > 0): ?>
<?php foreach($errors as $error): ?>
<p class="alert alert-danger">
    <?= $error;?>
</p>
<?php endforeach;?>
<?php endif;?>