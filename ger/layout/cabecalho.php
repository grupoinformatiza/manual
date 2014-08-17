<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="sr-only">Abrir navegação</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
          <a class="navbar-brand" href="<?php echo ROOT_PATH ?>ger/index.php"><img src="<?php echo ROOT_PATH ?>imagens/informatiza_pequeno.png"> Informatiza</a>
      </div>
      <div class="collapse navbar-collapse">
        <ul class="nav navbar-nav">
            <li <?php Suporte\ViewHelper::getMenuAtivo('usuario'); ?>><a href="<?php echo ROOT_PATH ?>ger/usuario/lista_usuario.php">Usuário</a></li>
            <li <?php Suporte\ViewHelper::getMenuAtivo('tutorial'); ?>><a href="<?php echo ROOT_PATH ?>ger/tutorial/lista_tutorial.php">Tutorial</a></li>
            <li <?php Suporte\ViewHelper::getMenuAtivo('topico'); ?>><a href="<?php echo ROOT_PATH ?>ger/topico/lista_topico.php">Tópico</a></li>
          <!--<li><a href="rel_estatistica.php">Estatística</a></li>-->
        </ul>
      </div><!--/.nav-collapse -->
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="confirmDelete" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">Fechar</span>
        </button>
        <h4 class="modal-title" id="confirmDeleteLabel">Informatiza - Confirmação</h4>
      </div>
      <div class="modal-body">
        Deseja mesmo deletar este registro?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <a type="button" class="btn btn-danger" id="btnConfirma">Deletar</a>
      </div>
    </div>
  </div>
</div>
