<?php
    require_once '../config.php';
    if(isset($_POST['txtLogin'])){
        try{
            \Suporte\Autenticacao::autenticar($_POST['txtLogin'], $_POST['txtSenha']);
        } catch (Exception $ex) {
            $erro = $ex->getMessage();
        }
    }
    if(isset($_GET['acao']) && $_GET['acao']== 'sair'){
        try{
            Suporte\Autenticacao::sair();
            $sucesso = "Logout efetuado com sucesso";
        } catch (Exception $ex) {
            $erro = $ex->getMessage();
        }
    }
    if(isset($_GET['erro']))
        $erro = $_GET['erro'];
?>

<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Entrar - Administração</title>
        <link rel="stylesheet" href="../libs/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="login.css">
    </head>
    <body role="document">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <?php require_once 'layout/mensagens.php'; ?>
                    <h1>Entrar</h1>
                    <form name="frmLogin" id="frmLogin" method="post" action="login.php">
                        <div class="form-group has-feedback">
                            <label for="txtlogin" class="sr-only">Login</label>
                            <span class="glyphicon form-control-feedback glyphicon-user"></span>
                            <input type="text" class="form-control input-lg" placeholder="Login" autofocus="true" name="txtLogin" id="txtLogin"/>
                        </div>
                        <div class="form-group has-feedback">
                            <label for="txtLogin" class="sr-only">Senha</label>
                            <span class="glyphicon form-control-feedback glyphicon-lock"></span>
                            <input type="password" class="form-control input-lg" placeholder="Senha" id="txtSenha" name="txtSenha"/>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-lg btn-primary pull-right">OK</button>        
                        </div>
                    </form>
                </div>
            <div/>
        </div>
    </body>
    <script type="text/javascript" src="../libs/jquery-1.11.1.min.js" ></script>
    <script type="text/javascript" src="../libs/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="./layout/default.js"></script>
</html>
