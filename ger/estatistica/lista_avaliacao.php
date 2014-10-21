<?php
require_once '../../config.php';


    //if(!isset($pgControllerTop))
        //$pgControllerTop = Servico\TopicoDAO::listarPesquisa($titulo,$tutorial);
    //$avaliacoes = Servico\EstatisticaDAO::listaTop10Avalia();
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
            <h4>Top 10: mais úteis</h4>
            <div class="row">
                    <div class="col-md-5">
                        <div class="panel" id="tabelaTop10">
                            <div class="panel-body" id="tabelaTop10">
                                <div class="table-responsive">
                                    <table class="panel" >
                                        <thead> 
                                            <tr>
                                                <td class="col-sm-1 text-center">Código</td>
                                                <td class="col-sm-2 text-center">Likes</td>
                                                <td class="col-sm-2 text-center">Dislikes</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php //foreach($avaliacoes as $ava): ?>
                                            <tr>
                                                <td><?php $ava->Topico ?></td>
                                                <td class="text-center">                                                                                                                
                                                    <a>
                                                        <?php $ava->Topico ?> <span class="glyphicon glyphicon-thumbs-up"></span>
                                                    </a>
                                                </td>
                                                <td class="text-center">
                                                    <a>
                                                        <?php $ava->Topico ?> <span class="glyphicon glyphicon-thumbs-down"></span>
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php //endforeach; ?>
                                        </tbody>
                                    </table>
                                </div> <!-- table responsive -->
                            </div>
                        </div>    
                    </div>
            </div>
            <h4>Avaliação dos tópicos: </h4>
            <select class="form-control input-mini" id="cmbTipoPesquisa" name="cmbTipoPesquisa">
                            <option value="0">-- Selecione --</option>
                            <option value="1">Pesquisa por título</option>
                            <option value="2">Pesquisa por tutorial</option>
            </select>
            <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead> 
                                    <tr>
                                        <td class="col-sm-1">Código</td>
                                        <td class="col-sm-5">Título</td>
                                        <td class="col-sm-1">Tutorial</td>
                                        <td class="col-sm-2">Likes</td>
                                        <td class="col-sm-2">Dislikes</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php //foreach($pgControllerTop->res as $ava) : ?>
                                    <tr>
                                        <td>1</td>
                                        <td>Teste</td>
                                        <td>1</td>
                                        <td class="text-center">                                                                                                                
                                            <a>
                                                43534 <span class="glyphicon glyphicon-thumbs-up"></span>
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <a>
                                                4 <span class="glyphicon glyphicon-thumbs-down"></span>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php //endforeach; ?>
                                </tbody>
                            </table>
                        </div> <!-- table responsive -->
                    </div>                               
            </div>
        </div>
    </body>
    <script type="text/javascript" src="../../libs/jquery-1.11.1.min.js" ></script>
    <script type="text/javascript" src="../../libs/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../layout/default.js"></script>    
</html>


