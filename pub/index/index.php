<?php 
define('ROOT_PATH', '../../');
require "../../config.php";
    
    $top_titulo = null;
    $top_conteudo = null;
    $top_codigo = null;

    if(isset($_GET['acao'])){
        switch($_GET['acao']){
          
            case 'listartopico':                
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
                    //checando se for ajax
                    if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
                        $ret['titulo'] = $top_titulo;
                        $ret['conteudo'] = $top_conteudo;
                        $ret['codigo'] = $top_codigo;
                        die(json_encode($ret));
                    }
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
                    
                    <ul class="nav nav-sidebar">
                        <?php foreach($tutoriais as $tut) : ?>
                            <li class="nav-header"><a href="index.php?acao=listartopico&cod=<?php echo $tut->Codigo; ?>"> <?php echo $tut->Nome; ?> </a></li>
                            <?php $topicos = \Servico\TopicoDAO::listarTop($tut->Codigo); ?>
                            <?php foreach($topicos as $top) : ?>
                            <li><a href="index.php?acao=exibirtopico&cod=<?php echo $top->Codigo; ?>"><?php echo $top->Titulo; ?></a></li>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    </ul>                
                </div>
                
                <div class="col-sm-10 col-sm-offset-2 col-md-10 col-md-offset-2 main">
                    <?php require_once '../../ger/layout/mensagens.php'; ?>
                    <?php if(!is_null($top_titulo)) : ?>    
                        <h1 id="tituloTopico"><?php echo $top_titulo ?></h1>
                        <p><?php echo $top_conteudo ?></p> 

                        <?php  if(Suporte\Autenticacao::checkLogin()) : ?>
                            <a class="btn btn-default btn-md pull-right" id="btnEditar" href="../../ger/topico/manut_topico.php?acao=editar&codigo=<?php echo $top_codigo; ?>" target="_blank">
                                <span class="glyphicon glyphicon-edit"></span> Editar
                            </a>
                        <?php endif; ?>
                    
                    <?php endif; ?>
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
                        
                    </div>
                </div>
            </div>
        </div>
        
    </body>
    <script type="text/javascript" src="../../libs/jquery-1.11.1.min.js" ></script>
    <script type="text/javascript" src="../../libs/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="index.js"></script>
</html>
