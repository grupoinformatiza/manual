<?php 
define('ROOT_PATH', '../../');
require "../../config.php";
$top_titulo = null;
$top_conteudo = null;
$top_codigo = null;
if(isset($_GET['topico'])){ //ordenação de tópicos
    try{
        \Servico\TopicoDAO::ajustarOrdemTopico($_GET['topico']);
        $ret['status'] = true;
    } catch (Exception $ex) {
        $ret['status'] = false;
        $ret['erro']   = $ex->getMessage();
    }
    die(json_encode($ret));
}

if(isset($_GET['tipo']))
    $tipo = $_GET['tipo'];
else
    $tipo = '';
$tutoriais = Servico\TutorialDAO::listarTutoriais($tipo);
?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Manual Informatiza</title>
        <link rel="stylesheet" href="../../libs/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="../../default.css" />
        <link rel="stylesheet" href="../../libs/ui/jquery-ui.min.css">
    </head>
    <body role="document">
        <?php  require_once '../layout/cabecalho.php'; ?>
        <div class="container-fluid" role="main">
            <div class="row">
                <div class="col-md-2 col-sm-2 col-xs-12 sidebar menulateral">
                          
                    <form class="form" name="frmProcurar" id="frmProcurar" method="get" action="index.php" role="search">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" name="pesquisa" class="form-control" placeholder="Procurar tópicos...">
                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <?php foreach($tutoriais as $tut) : ?>
                    <ul class="nav nav-sidebar">
                        
                        <li class="nav-header">
                            <a href="#"> 
                                <?php echo $tut->Nome; ?>
                                
                                <?php if(Suporte\Autenticacao::checkLogin()) : ?>
                                <button class="btn btn-primary pull-right btn-xs btn-config" title="Alterar Ordem dos Tópicos">
                                    <span class="glyphicon glyphicon-cog"></span>
                                </button>
                                <div class="btn-group pull-right hidden">
                                    <button class="btn btn-success btn-xs btn-salva" title="Salvar">
                                        <span class="glyphicon glyphicon-ok"></span>
                                    </button>
                                    <button class="btn btn-warning btn-xs btn-canc" title="Cancelar">
                                        <span class="glyphicon glyphicon-remove"></span>
                                    </button>                                    
                                </div>
                                <?php endif; ?>
                            </a>
                        </li>
                            <?php $topicos = \Servico\TopicoDAO::listarTop($tut->Codigo); ?>
                            
                            <?php foreach($topicos as $top) : ?>
                                <li class="nav-item" id="topico_<?php echo $top->Codigo; ?>">
                                    <a href="visualiza_topico.php?cod=<?php echo $top->Codigo; ?>"> 
                                        <?php echo $top->Titulo; ?>
                                        <span class="glyphicon glyphicon-sort pull-left hidden"></span>                                        
                                    </a> 
                                </li>
                            <?php endforeach; ?>
                        
                    </ul>                
                    <?php endforeach; ?>
                </div>
                
                <div class="col-sm-10 col-sm-offset-2 col-md-10 col-md-offset-2 main">
                    <div id="topicoConteudo">
                        <?php require_once '../../ger/layout/mensagens.php'; ?>

                        <?php include 'visualiza_topico.php' ?>
                    </div>
                    
                    <div id="resultadoPesquisa">
                        
                        <?php if(isset($_GET['pesquisa'])) include 'pesquisa_topico.php' ?>
                    
                    </div>
                    
                    <div id="tutorialSelecionado">
                        <?php include 'pesquisa_tutorial.php'?>
                    </div>
                </div>
            </div>
            
        </div>
        
        
        <div class="modal fade" id="editarTopico" tabindex="-1" role="dialog" aria-labelledby="editarTopicoLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                </div>
            </div>
        </div>
        
    </body>
    <script type="text/javascript" src="../../libs/jquery-1.11.1.min.js" ></script>
    <script type="text/javascript" src="../../libs/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="index.js"></script>
    <script type="text/javascript" src="../../libs/ui/jquery-ui.min.js"></script>
    <script type="text/javascript" src="../../libs/ui/jquery.ui.touch-punch.min.js"></script>
</html>
