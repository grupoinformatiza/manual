<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Cadastrar Tutorial</title>
        <link rel="stylesheet" href="../libs/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="layout/default.css">
    </head>
    <body role="document">
        <?php require_once 'layout/cabecalho.php';?>
        <div class="container">
            <div class="page-header">
                <h1>Tutorial</h1>
            </div>
            <div class="panel panel-default">
                <div class="panel-body">
                    <form name="frmManutTutorial" id="frmManutTutorial" class="form" action="manut_tutorial.php" method="post">
                        <div class="form-group">
                            <label for="txtNome">Nome</label>
                            <input type="text" name="txtNome" id="txtNome" class="form-control input-md"/>
                        </div>
                        
                        <div class="form-group">
                            <label for="cmbTipo">Tipo do tutorial</label>
                            <select class="form-control input-md" id="cmbTipo" name="cmbTipo">
                                <option value="1">Usuário</option>
                                <option value="2">Administrador</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="cmbTipo">Imagem ilustrativa</label>
                        </div>
                        
                        
                        <!-- Controles do formulario -->
                        <div class="form-inline pull-right">
                            <button class="btn btn-default btn-md">Cancelar</button>
                            <button class="btn btn-default btn-md">Limpar</button>                            
                            <button class="btn btn-primary btn-md">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        

    </body>
    <script type="text/javascript" src="../libs/jquery-1.11.1.min.js" ></script>
    <script type="text/javascript" src="../libs/bootstrap/js/bootstrap.min.js"></script>
</html>
