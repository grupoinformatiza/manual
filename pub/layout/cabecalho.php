<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Abrir Menu</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>                    
                    <a class="navbar-brand" href="../../index.php">
                        <img src="<?php echo ROOT_PATH ?>imagens/informatiza_pequeno.png"/> Informatiza
                    </a>                    
                    <button type="button" class="btn pull-right visible-xs navbar-btn indice" data-toggle="menulateral">
                        <span class="glyphicon glyphicon-list-alt"></span> Índice
                    </button>
                </div> 
             
                <div class="collapse navbar-collapse">                   
                    
                    <ul class="nav navbar-nav">
                        <li <?php Suporte\ViewHelper::getMenuAtivo('index'); ?>><a href="<?php echo ROOT_PATH ?>pub/index/index.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
                        <?php if(Suporte\Autenticacao::checkLogin()) : ?>
                        <li <?php Suporte\ViewHelper::getMenuAtivo('cadastro'); ?>><a href="<?php echo ROOT_PATH ?>ger/index.php">Cadastros</a></li>
                        <?php endif; ?>
                        <li <?php Suporte\ViewHelper::getMenuAtivo('sobre'); ?>><a href="<?php echo ROOT_PATH ?>pub/sobre/sobre.php">Sobre</a></li>
                    </ul>
                    
                    
                    <div class="navbar-right">
                        <a class="navbar-btn btn btn-success" href="<?php echo ROOT_PATH ?>pub/usuario/cadastro_usuario.php">Inscreva-se</a>
                    </div>
                    
                    <ul class="nav navbar-nav navbar-right" id="navbar-tipos">
                        <li <?php Suporte\ViewHelper::getMenuAtivo('usuario'); ?>><a href="<?php echo ROOT_PATH ?>pub/index/index.php?tipo=1">Usuário</a></li>
                        <li <?php Suporte\ViewHelper::getMenuAtivo('desenvolvedor'); ?>><a href="<?php echo ROOT_PATH ?>pub/index/index.php?tipo=2">Desenvolvedor</a></li>                                                
                    </ul>
                    
                </div>
            </div>
        </div>