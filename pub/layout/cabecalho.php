<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Abrir Menu</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <button type="button" class="btn btn-primary btn-xs pull-left visible-xs" data-toggle="menulateral">
                        Índice
                    </button>
                    <a class="navbar-brand" href="../../index.php">
                        <img src="<?php echo ROOT_PATH ?>imagens/informatiza_pequeno.png"/> Informatiza
                    </a>
                    
                </div>
                <div class="collapse navbar-collapse">
                    
                    <ul class="nav navbar-nav">
                        <li <?php Suporte\ViewHelper::getMenuAtivo('index'); ?>><a href="<?php echo ROOT_PATH ?>pub/index/index.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
                        <li <?php Suporte\ViewHelper::getMenuAtivo('sobre'); ?>><a href="<?php echo ROOT_PATH ?>">Sobre</a></li>
                    </ul>
                    
                    
                    <div class="navbar-right">
                        <a class="navbar-btn btn btn-success" href="<?php echo ROOT_PATH ?>pub/usuario/cadastro_usuario.php">Inscreva-se</a>
                    </div>
                    
                    <ul class="nav navbar-nav navbar-right" id="navbar-tipos">
                        <li><a href="<?php echo ROOT_PATH ?>">Desenvolvedor</a></li>
                        <li><a href="<?php echo ROOT_PATH ?>">Usuário</a></li>
                    </ul>
                    
                </div>
            </div>
        </div>