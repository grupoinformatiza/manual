<?php if(isset($erro)) : ?>

<div class="alert alert-danger alert-dismissable fade">
    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Fechar</span></button>
    <?php echo $erro ?>
</div>

<?php endif ?>

<?php if(isset($sucesso)) : ?>

<div class="alert alert-success fade"><?php echo $sucesso ?></div>

<?php endif ?>

