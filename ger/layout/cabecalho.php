<?php Suporte\Autenticacao::paginaSegura() ?>
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
            <li><a href="<?php echo ROOT_PATH ?>pub/index/index.php">Manual</a></li>
            <li <?php Suporte\ViewHelper::getMenuAtivo('usuario'); ?>><a href="<?php echo ROOT_PATH ?>ger/usuario/lista_usuario.php">Usuário</a></li>
            <li <?php Suporte\ViewHelper::getMenuAtivo('tutorial'); ?>><a href="<?php echo ROOT_PATH ?>ger/tutorial/lista_tutorial.php">Tutorial</a></li>
            <li <?php Suporte\ViewHelper::getMenuAtivo('topico'); ?>><a href="<?php echo ROOT_PATH ?>ger/topico/lista_topico.php">Tópico</a></li>
          <!--<li><a href="rel_estatistica.php">Estatística</a></li>-->
        </ul>
        <p class="navbar-text pull-right">
         <?php
            if(isset($_SESSION['web']['usuario'])): $usu = $_SESSION['web']['usuario'];
         ?>
         
         <div class="navbar-right">
             <a class="navbar-btn btn btn-primary btn-sm" data-toggle="modal" data-target="#alterarDados">
                 <span class="glyphicon glyphicon-cog"></span> Configurações
             </a>   
             <a class="navbar-btn btn btn-sm text-muted navbar-link" href="<?php echo ROOT_PATH ?>ger/login.php?acao=sair">
                 <span class="glyphicon glyphicon-log-out"></span> Sair
             </a>
         </div>
         <div class="navbar-right">
             <p class="navbar-text"><?php echo $usu->Nome; ?></p>
         </div> 
         <?php endif; ?>
        </p>
      </div><!--/.nav-collapse -->
    </div>
</div>

<!-- Modal Confirmação -->
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
        <a type="button" class="btn btn-danger" id="btnConfirma">Deletar</a>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>       
      </div>
    </div>
  </div>
</div>

<!-- Modal Dados -->
<div class="modal fade" id="alterarDados" tabindex="-1" role="dialog" aria-labelledby="alterarDadosLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">Fechar</span>
        </button>
        <h4 class="modal-title" id="alterarDadosLabel">Alteração de Dados</h4>
      </div>
      <form name="frmAlterarSenha" id="frmAlterarSenha" method="post" action="<?php echo ROOT_PATH ?>ger/usuario/manut_usuario.php">
        <div class="modal-body">
            <div id="erroPlaceholder"></div>
                
                <input type="hidden" name="acao" value="alterarSenha" />
                <div class="form-group">
                    <label for="txtAlSenhaAtual">Senha Atual</label>
                    <input type="password" class="form-control input-md" name="txtAlSenhaAtual" id="txtAlSenhaAtual"  />
                </div>    
                <div class="form-group">
                    <label for="txtAlNovaSenha">Nova Senha</label>
                    <input type="password" class="form-control input-md" name="txtAlNovaSenha" id="txtAlNovaSenha" />
                </div>    
                <div class="form-group">
                    <label for="txtAlNovaSenhaConf">Confirmação da Senha</label>
                    <input type="password" class="form-control input-md" name="txtAlNovaSenhaConf" id="txtAlNovaSenhaConf" />
                </div>    

        </div>
        <div class="modal-footer">          
          <button type="submit" class="btn btn-primary" id="btnConfirma"><span class="glyphicon glyphicon-floppy-disk"></span> Salvar Alterações</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        </div>
      </form>
    </div>
  </div>
</div>

