<?php
require_once '../../config.php';

    if(isset($_GET['acao'])){
            switch($_GET['acao']){
                case 'deletar':

                    $codigo = $_GET['codigo'];

                    try{
                        Servico\TutorialDAO::deletarTutorial($codigo);
                        $sucesso = "Tutorial deletado com sucesso";
                    } catch (Exception $ex) {
                        $erro = $ex->getMessage();
                    }

                    break;
                case 'pesquisa':

                    $nome = $_GET['txtPesquisarTutorial'];

                    try{
                        $pgControllerTut = \Servico\TutorialDAO::listarPorNome($nome);
                    } catch (Exception $ex) {
                        $erro = $ex->getMessage();
                    }


                    break;

            }
        }
        if(!isset($pgControllerTut))
            $pgControllerTut = \Servico\TutorialDAO::listar();


?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Cadastrar Tutorial</title>
        <link rel="stylesheet" href="../../libs/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="../layout/default.css">
    </head>
    <body role="document">
        <?php require_once '../layout/cabecalho.php';?>
        <div class="container">
        
            <div class="page-header">
                <h1>Tutoriais</h1>
            </div>
            
            <?php require_once '../layout/mensagens.php'; ?>
            
            <!-- Linha para novo e busca -->
            <div class="row">
                <div class="col-md-1 form-group">
                    <a href="manut_tutorial.php?acao=novo" class="btn btn-success btn-md">
                        <span class="glyphicon glyphicon-plus"></span> Novo
                    </a>
                </div>
                <form method="get" name="frmBuscarTutorial" id="frmBuscarTutorial" action="lista_tutorial.php">
                    <input type="hidden" name="acao" value="pesquisa" />
                    <div class="col-md-4 form-group">
                        <div class="input-group">
                            <input type="text" name="txtPesquisarTutorial" id="txtPesquisarTutorial" class="form-control input-md" placeholder="Procurar tutoriais..."/>
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-search"></span>
                            </span>
                        </div>
                    </div>
                </form> 
            </div>
            <!-- Linha para tabela -->
            <div class="row">
                <div class="col-md-12">
                    <?php $pgControllerTut->pag->printResultBar(); ?>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead> 
                                <tr>
                                    <td class="col-sm-3">Código</td>
                                    <td class="col-sm-4">Nome</td>
                                    <td class="col-sm-4">Tipo</td>
                                    <td class="col-sm-1"></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($pgControllerTut->res as $tut) : ?>
                                <tr>
                                    <td><?php echo $tut->Codigo; ?></td>
                                    <td><?php echo $tut->Nome; ?></td>
                                    <td><?php echo $tut->TipoDescricao; ?></td>
                                    <td class="text-right">                                                                              
                                        <a href="manut_tutorial.php?acao=editar&codigo=1" class="btn btn-warning btn-xs">
                                            <span class="glyphicon glyphicon-pencil"></span>
                                        </a>
                                        <a href="manut_tutorial.php?acao=deletar&codigo=1" class="btn btn-danger btn-xs">
                                            <span class="glyphicon glyphicon-remove"></span>
                                        </a>

                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div> <!-- table responsive -->
                </div> <!-- col que envolve tabela -->
            </div> <!--/row (fim da linha para a tabela de cadastro)-->
            
            <!-- Linha da paginação -->
            <?php $pgControllerTut->pag->printNavigationBar(); ?>
            
        </div> <!-- container -->
        
    </body>
    <script type="text/javascript" src="../../libs/jquery-1.11.1.min.js" ></script>
    <script type="text/javascript" src="../../libs/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../layout/default.js"></script>
</html>
