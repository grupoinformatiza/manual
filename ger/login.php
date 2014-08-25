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
                            <label class="sr-only">Login</label>
                            <span class="glyphicon form-control-feedback glyphicon-user"></span>
                            <input type="text" class="form-control input-lg" placeholder="Login" autofocus="true"/>
                        </div>
                        <div class="form-group has-feedback">
                            <label class="sr-only">Senha</label>
                            <span class="glyphicon form-control-feedback glyphicon-lock"></span>
                            <input type="password" class="form-control input-lg" placeholder="Senha"/>
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
    <script type="text/javascript" src="layout/default.js"></script>
</html>
