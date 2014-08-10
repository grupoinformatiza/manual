<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Cadastrar Tópico</title>
        <link rel="stylesheet" href="../libs/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="layout/default.css">
    </head>
    <body role="document">
        <?php require_once 'layout/cabecalho.php';?>
        <div class="container">
            <div class="page-header">
                <h1>Tópico</h1>
            </div>
            <div class="panel panel-default">
                <div class="panel-body">
                    <form name="frmManutTopico" id="frmManutTopico" class="form" action="manut_topico.php" method="post">
                        <div class="form-group">
                            <label for="txtTitulo">Título</label>
                            <input type="text" name="txtTitulo" id="txtTitulo" class="form-control input-md"/>
                        </div>

                        <div class="form-group">
                            <label for="txtConteudo">Conteúdo</label>
                            <input type="text" name="txtConteudo" id="txtConteudo" class="form-control"/>
                        </div>
                        
                        <!-- Combo carregado com os tutoriais disponíveis -->
                        <div class="form-group">
                            <label for="cmbTutorial">Tutorial</label>
                            <select class="form-control input-md" id="cmbTutorial" name="cmbTutorial">
                                <option value="1">Carregar os tutoriais existentes</option>
                            </select>
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

