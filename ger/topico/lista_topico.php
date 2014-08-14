<?php
require_once '../../config.php';
?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Cadastrar Tópico</title>
        <link rel="stylesheet" href="../../libs/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="../layout/default.css">
    </head>
    <body role="document">
        <?php require_once '../layout/cabecalho.php';?>
        
        <div class="container">
        
            <div class="page-header">
                <h1>Tópicos</h1>
            </div>
            <div class="alert alert-danger">Tópico não encontrado</div>
            <!-- Linha para novo e busca -->
            <div class="row">
                <div class="col-md-1 form-group">
                    <a href="manut_topico.php?acao=novo" class="btn btn-success btn-md">
                        <span class="glyphicon glyphicon-plus"></span> Novo
                    </a>
                </div>
                <div class="input col-md-4 form-group">
                    <div class="input-group">
                        <input type="text" name="txtPesquisarTopico" id="txtPesquisarTopico" class="form-control input-md" placeholder="Procurar tópicos..."/>
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-search"></span>
                        </span>
                    </div>                   
                    
                </div> 
                <div class="col-md-4 form-group">
                    <select class="form-control input-md" id="cmbTutorial" name="cmbTutorial">
                        <option value="1">Selecionar tutoriais</option>
                    </select>
                </div>
            </div> <!--/row(fim da linha para busca e novo)-->
            <!-- Linha para tabela -->
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead> 
                                <tr>
                                    <td>Código</td>
                                    <td>Título</td>
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>001</td>
                                    <td>Introdução</td>
                                    <td class="text-right">                                                                        
                                        
                                        <a href="manut_topico.php?acao=editar&codigo=1" class="btn btn-warning btn-xs">
                                            <span class="glyphicon glyphicon-pencil"></span>
                                        </a>
                                        <a href="manut_topico.php?acao=deletar&codigo=1" class="btn btn-danger btn-xs">
                                            <span class="glyphicon glyphicon-remove"></span>
                                        </a>

                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div> <!-- table responsive -->
                </div> <!-- col que envolve tabela -->
            </div> <!--/row (fim da linha para a tabela de cadastro)-->
            <div class="row">
                <div class="col-md-4 col-md-offset-4 text-center">
                     <ul class="pagination">
                        <li><a href="#">&laquo;</a></li>
                        <li class="active"><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">5</a></li>
                        <li><a href="#">&raquo;</a></li>
                      </ul>
                </div>
            </div>
        </div> <!-- container -->
    </body>
    <script type="text/javascript" src="../../libs/jquery-1.11.1.min.js" ></script>
    <script type="text/javascript" src="../../libs/bootstrap/js/bootstrap.min.js"></script>
</html>

