<?php 
define('ROOT_PATH', '../../');
require "../../config.php";
    $top_titulo = null;
    $top_conteudo = null;
    $top_codigo = null;

    if(isset($_GET['acao'])){
        switch($_GET['acao']){
          
            case 'listartutorial':                
                try{
                    $codigo = $_GET['cod'];  
                    
                    $topico = \Servico\TopicoDAO::listar('', $codigo);
                                  
                    $titulo = $topico->Titulo;
                    $conteudo = $topico->Conteudo;
                    $IDtutorial = $topico->Tutorial->Codigo;
                }catch(Exception $ex){
                    $erro = $ex->getMessage();
                }               
                break; 
            
            case 'exibirtopico':
                try{
                    $codigo = $_GET['cod'];
                    $topico = \Servico\TopicoDAO::getTopico($codigo);  
                    $top_titulo = $topico->Titulo;
                    $top_conteudo = $topico->Conteudo;
                    $top_codigo = $codigo;
                } catch (Exception $ex) {
                    
                    $erro = $ex->getMessage();
                }
                
        }
    }



if(!isset($pgControllerTut))
    $pgControllerTut = Servico\TutorialDAO::listarTutoriais();
$tutoriais = Servico\TutorialDAO::listarTutoriais();
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
        <?php  require_once '../layout/cabecalho.php'; ?>s
        <div class="container-fluid" role="main">
            <div class="row">
                <div class="col-md-2 col-sm-2 col-xs-12 sidebar menulateral">
                          
                    <form class="form" role="search">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Procurar tópicos...">
                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <?php foreach($tutoriais as $tut) : ?>
                    <ul class="nav nav-sidebar">
                        
                        <li class="nav-header">
                            <a href="index.php?acao=listartutorial&cod=<?php echo $tut->Codigo; ?>"> 
                                <?php echo $tut->Nome; ?> 
                                <button class="btn btn-primary pull-right btn-xs btn-config" title="Alterar Ordem dos Tópicos">
                                    <span class="glyphicon glyphicon-cog"></span>
                                </button>
                                <div class="btn-group pull-right hidden">
                                    <button class="btn btn-warning btn-xs btn-canc" title="Cancelar">
                                        <span class="glyphicon glyphicon-remove"></span>
                                    </button>
                                    <button class="btn btn-success btn-xs btn-salva" title="Salvar">
                                        <span class="glyphicon glyphicon-ok"></span>
                                    </button>
                                </div>
                                
                            </a>
                        </li>
                            <?php $topicos = \Servico\TopicoDAO::listarTop($tut->Codigo); ?>
                            
                            <?php foreach($topicos as $top) : ?>
                                <li class="nav-item" id="topico_<?php echo $tut->Codigo; ?>">
                                    <a href="index.php?acao=exibirtopico&cod=<?php echo $top->Codigo; ?>">
                                        <?php echo $top->Titulo; ?>
                                        <span class="glyphicon glyphicon-sort pull-right hidden"></span>
                                    </a> 
                                </li>
                            <?php endforeach; ?>
                        
                    </ul>                
                    <?php endforeach; ?>
                </div>
                
                <div class="col-sm-10 col-sm-offset-2 col-md-10 col-md-offset-2 main">
                    <div id="topicoConteudo">
                        <?php require_once '../../ger/layout/mensagens.php'; ?>

                        <h1 id="tituloTopico"><?php echo $top_titulo ?></h1>
                        <p id="conteudoTopico"><?php echo $top_conteudo ?></p> 
                        <?php if(!is_null($top_titulo)) : ?>    
                            <?php  if(Suporte\Autenticacao::checkLogin()) : ?>
                                <a class="btn btn-default btn-md pull-right" id="btnEditar" href="../../ger/topico/manut_topico.php?acao=editar&codigo=<?php echo $top_codigo; ?>" target="_blank">
                                    <span class="glyphicon glyphicon-edit"></span> Editar
                                </a>
                            <?php endif; ?>

                        <?php endif; ?>
                    </div>
                </div>
            </div>
            
        </div>
        
        
        <div class="modal fade" id="editarTopico" tabindex="-1" role="dialog" aria-labelledby="editarTopicoLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Fechar</span>
                        </button>
                        <h4 class="modal-title" id="editarTopicoLabel">Editar Tópico</h4>
                    </div>
                    <div class="modal-body" id="contentEditarTopico">
                        Os campos devem ser colocados aqui...<br />
                        (Talvez de uma forma mais simplificada)
                    </div>
                    <div class="modal-footer">
                        
                    </div>
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
