<?php
    require_once '../../config.php';
    
    if(isset($_POST['acao'])){
        switch($_POST['acao']){
            case 'gravar':
                
                try{
                    $tutorial = new Entidade\Tutorial();
                    $tutorial->Nome = $_POST['txtNome'];
                    $tutorial->Tipo = $_POST['cmbTipo'];                    
                    Servico\TutorialDAO::gravar($tutorial);
                    $sucesso = "Tutorial gravado com sucesso!";
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
    </head>
    <body role="document">
        <?php require_once '../layout/cabecalho.php';?>
        <div class="container">
            <div class="page-header">
                <h1>Tutorial</h1>
            </div>
            
            <?php if(isset($erro)) : ?>
            
            <div class="alert alert-danger"><?php echo $erro ?></div>
            
            <?php endif ?>
            
            <?php if(isset($sucesso)) : ?>
            
            <div class="alert alert-success"><?php echo $sucesso ?></div>
            
            <?php endif ?>
            
            
            <form name="frmManutTutorial" id="frmManutTutorial" class="form" action="manut_tutorial.php" method="post">
                <input type="hidden" name="acao" value="gravar" />
                <div class="panel panel-info">
                    <div class="panel-body">
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
</html>
