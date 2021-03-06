<?php
require_once '../../config.php';

    $titulo   = "";
    $tutorial = 0;

    if (isset($_GET['acao'])){        
        switch($_GET['acao']){
            case 'pesquisa':
                $titulo   = $_GET['txtPesquisarTopico'];
                $tutorial = $_GET['cmbTutorial'];
                break;
        }
    }
        
    $top10mais = Servico\EstatisticaDAO::listaTop10Mais();
    $top10menos = Servico\EstatisticaDAO::listaTop10Menos();

    $pgControllerEst = Servico\EstatisticaDAO::listarTopicos ($titulo, $tutorial);
    
    $tutoriais = Servico\TutorialDAO::listarTutoriais();    

?>

<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Estatística das avaliações</title>
        <link rel="stylesheet" href="../../libs/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="../layout/default.css">
    </head>
    <body role="document">
        <?php require_once '../layout/cabecalho.php';?>
        <div class="container">
            <div class="page-header">
                <h1>Avaliações</h1>
            </div>
            <h3>Top 10</h3>
            <div class="row">
                    <div class="col-md-6">
                        <div class="panel panel-success">
                            <div class="panel-heading">
                               <h4 class="panel-title">Mais úteis</h4> 
                            </div> 
                            <div class="panel-body ">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <td class="col-md-5">Título</td>
                                                <td class="col-md-3 text-center">Likes</td>
                                                <td class="col-md-3 text-center">Dislikes</td>
                                                <td></td>  
                                            </tr>
                                        </thead> 
                                        <tbody>
                                            <?php foreach($top10mais as $topmais) : ?>
                                            <tr>
                                                <td><?php echo substr($topmais->Topico,0,28); ?></td>                                                
                                                <td class="text-center">                                                                                                                
                                                    <a class="text-success">
                                                        <?php echo $topmais->Like; ?> <span class="glyphicon glyphicon-thumbs-up"></span>
                                                    </a>
                                                </td>
                                                <td class="text-center">
                                                    <a class="text-danger">
                                                        <?php echo $topmais->Dislike; ?> <span class="glyphicon glyphicon-thumbs-down"></span>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="comentarios_topico.php?acao=exibirComentario&codigo=<?php echo $topmais->CodigoTop; ?>" class="text-muted pull-right btn-mostraComentario">
                                                        <span class="glyphicon glyphicon-comment"></span>
                                                    </a>
                                                </td>
                                            <?php endforeach; ?>
                                            </tr>                              
                                        </tbody>
                                    </table>
                                </div><!--/table-responsive-->
                            </div><!--/panel-body-->    
                        </div><!--/panel-->    
                    </div><!--/col-->    
                    <div class="col-md-6">
                        <div class="panel panel-danger">
                            <div class="panel-heading">
                                <h3 class="panel-title">Menos úteis</h3> 
                            </div> 
                            <div class="panel-body ">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <td class="col-md-5">Título</td>
                                                <td class="col-md-3 text-center">Likes</td>
                                                <td class="col-md-3 text-center">Dislikes</td>
                                                <td></td>
                                            </tr>
                                        </thead> 
                                        <tbody>
                                            
                                            <?php foreach($top10menos as $topmenos) : ?>
                                            <tr>
                                                <td><?php echo substr($topmenos->Topico,0,28); ?></td>
                                                
                                                <td class="text-center">     
                                                    <a class="text-success">
                                                         <?php echo $topmenos->Like; ?> <span class="glyphicon glyphicon-thumbs-up"></span>
                                                    </a>
                                                </td>
                                                <td class="text-center">
                                                    <a class="text-danger">
                                                        <?php echo $topmenos->Dislike; ?> <span class="glyphicon glyphicon-thumbs-down"></span>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="comentarios_topico.php?acao=exibirComentario&codigo=<?php echo $topmais->CodigoTop ;?>" class="text-muted pull-right btn-mostraComentario">
                                                        <span class="glyphicon glyphicon-comment"></span>
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                                                                           
                                        </tbody>
                                    </table>
                                </div><!--/table-responsive-->
                            </div><!--/panel-body-->    
                        </div><!--/panel-->    
                    </div><!--/col-->  
            </div><!--/row-->     
            <h3>Avaliação dos tópicos: </h3>
            
            <div class="row busca">                      
                <form method="get" name="frmBuscarTopico" id="frmBuscarTopico" action="lista_avaliacao.php">   
                    <input type="hidden" name="acao" value="pesquisa" />
                    <div class="col-md-4 form-group">
                        <div class="input-group">
                            <input type="text" name="txtPesquisarTopico" id="txtPesquisarTopico" class="form-control input-lg" placeholder="Procurar tópicos..."/>
                            <span class="input-group-btn">
                                <button class="btn btn-lg btn-default" type="submit">
                                    <span class="glyphicon glyphicon-search"></span>
                                </button>
                            </span>
                        </div>                   

                    </div> 
                    <!--<div class="col-md-4 form-group">
                        <select class="form-control input-lg" id="cmbTutorial" name="cmbTutorial">
                            <option value="0">-- Selecione o tutorial --</option>
                            <?php foreach($tutoriais as $tut) : ?>
                                <option value="<?php echo $tut->Nome; ?>" ><?php echo $tut->Nome . ' ('.$tut->TipoDescricao.')' ?></option>
                            <?php endforeach; ?>                         
                        </select>
                    </div>-->
                </form>
            </div> <!--/row(fim da linha para busca)-->
            <div class="row">
                    <div class="col-md-12">
                        <?php require_once '../layout/mensagens.php'; ?>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead> 
                                    <tr>
                                        <td class="col-sm-5">Título</td>
                                        <td class="col-sm-2 text-center">Tutorial</td>
                                        <td class="col-sm-2 text-center">Likes</td>
                                        <td class="col-sm-2 text-center">Dislikes</td>
                                        <td class="col-sm-1 "></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    <?php foreach($pgControllerEst->res as $ava) : ?>
                                    <tr>
                                        <td><?php echo $ava->Topico; ?></td>
                                        <td class="text-center"><?php echo $ava->Tutorial; ?></td>
                                        <td class="text-center">                                                                                                                
                                            <a class="text-success">
                                                <?php echo $ava->Like; ?> <span class="glyphicon glyphicon-thumbs-up"></span>
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <a class="text-danger">
                                                <?php echo $ava->Dislike; ?> <span class="glyphicon glyphicon-thumbs-down"></span>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="comentarios_topico.php?acao=exibirComentario&codigo=<?php echo $ava->CodigoTop; ?>" class=" pull-right btn-mostraComentario">
                                                <span class="glyphicon glyphicon-comment text-muted"></span>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>                                                                                 
                                </tbody>
                            </table>
                        </div> <!-- table responsive -->
                    </div>
            </div>
            <?php $pgControllerEst->pag->printNavigationBar(); ?> 
        </div>     
        
        <div class="modal fade" id="comentarios" tabindex="-1" role="dialog" aria-labelledby="comentTitulo" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                </div>
            </div>
        </div>
    </body>
    <script type="text/javascript" src="../../libs/jquery-1.11.1.min.js" ></script>
    <script type="text/javascript" src="../../libs/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../layout/default.js"></script>  
    <script type="text/javascript" src="lista_avaliacao.js"></script> 
</html>

