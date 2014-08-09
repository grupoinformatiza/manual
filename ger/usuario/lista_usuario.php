<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Usuários</title>
        <link rel="stylesheet" href="../../libs/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="../layout/default.css">
    </head>
    <body role="document">
        <?php require_once '../layout/cabecalho.php';?>
        
        <div class="container">
        
            <div class="page-header">
                <h1>Usuários</h1>
            </div>
            <div class="row">
                <div class="col-md-1">
                    <a href="manut_usuario.php?acao=novo" class="btn btn-success btn-md">
                        <span class="glyphicon glyphicon-plus"></span> Novo
                    </a>
                </div>
                <div class="input-group col-md-4">
                    
                    <input type="text" name="txtPesquisarUsuario" id="txtPesquisarUsuario" class="form-control input-md" placeholder="Procurar usuários..."/>
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-search"></span>
                    </span>
                    
                </div>        
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead> 
                                <tr>
                                    <td>Código</td>
                                    <td>Nome</td>
                                    <td>E-mail</td>
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>001</td>
                                    <td>Ana Paula Suaiden</td>
                                    <td>a.p.suaiden</td>
                                    <td class="text-right">
                                        
                                        
                                        
                                        <a href="manut_usuario.php?acao=editar&codigo=1" class="btn btn-warning btn-xs">
                                            <span class="glyphicon glyphicon-pencil"></span>
                                        </a>
                                        <a href="manut_usuario.php?acao=deletar&codigo=1" class="btn btn-danger btn-xs">
                                            <span class="glyphicon glyphicon-remove"></span>
                                        </a>

                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
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
        </div>
        
    </body>
    <script type="text/javascript" src="../../libs/jquery-1.11.1.min.js" ></script>
    <script type="text/javascript" src="../../libs/bootstrap/js/bootstrap.min.js"></script>
</html>
