<?php
    require_once '../../config.php';
    
    if(isset($_POST['acao'])){
        switch($_POST['acao']){
            case 'gravar':
                
                try{
                    $tutorial = new Entidade\Tutorial();
                    $tutorial->Nome = $_POST['txtNome'];
                    $tutorial->Tipo = $_POST['cmbTipo'];   
                    
                    if(isset($_FILES['filImagem']))
                        $tutorial->Imagem = $_FILES['filImagem'];
                                        
                    Servico\TutorialDAO::gravar($tutorial);
                    $sucesso = urlencode("Tutorial gravado com sucesso!");
                    header("Location: lista_tutorial.php?msg=$sucesso");
                } catch (Exception $ex) {
                    $erro = $ex->getMessage();
                }
                
                break;
        }
    }
    
    
?>

<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Cadastrar Tutorial</title>
        <link rel="stylesheet" href="../../libs/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="../layout/default.css">
        <link rel="stylesheet" href="manut_tutorial.css">
    </head>
    <body role="document">
        <?php require_once '../layout/cabecalho.php';?>
        <div class="container">
            <div class="page-header">
                <h1>Tutorial</h1>
            </div>
            
            <?php require_once '../layout/mensagens.php'; ?>
            
            
            <form name="frmManutTutorial" id="frmManutTutorial" class="form" action="manut_tutorial.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="acao" value="gravar" />
                <div class="panel panel-info">
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="txtNome">Nome</label>
                            <input type="text" name="txtNome" id="txtNome" autofocus="true" class="form-control input-md"/>
                        </div>
                        
                        <div class="form-group">
                            <label for="cmbTipo">Tipo do tutorial</label>
                            <select class="form-control input-md" id="cmbTipo" name="cmbTipo">
                                <option value="1">Usuário</option>
                                <option value="2">Administrador</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <span class="btn btn-default btn-md btn-file">
                                Enviar imagem ilustrativa...
                                <input type="file" id="filImagem" name="filImagem" accept="image/*" />
                            </span>
                        </div>
                        <div class="form-group hidden img-preview">
                            <div class="thumbnail">
                                <div class="progress">
                                    <div class="progress-bar progress-bar-success">
                                        <span class="sr-only progress-bar-label"></span>
                                    </div>
                                </div>
                                
                                <img src="" id="preview">
                            </div>
                            <p class="help-block">Pré visualização da imagem (Só será enviada quando clicar em salvar)</p>
                        </div>    
                    </div> <!-- /painel body(corpo do painel) -->
                </div> <!-- fim do painel -->
                <!-- Controles do formulario -->
                <div class="form-inline pull-right">
                    <a class="btn btn-default btn-md" href="lista_tutorial.php">Cancelar</a>
                    <button class="btn btn-default btn-md" type="reset">Limpar</button>                            
                    <button class="btn btn-primary btn-md" type="submit">Salvar</button>
                </div>
            </form>
                
        </div> <!-- /container -->
        
        

    </body>
    <script type="text/javascript" src="../../libs/jquery-1.11.1.min.js" ></script>
    <script type="text/javascript" src="../../libs/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../layout/default.js"></script>
    <script type="text/javascript" src="manut_tutorial.js"></script>
</html>
