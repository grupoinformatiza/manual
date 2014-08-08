<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Cadastrar Usuários</title>
        <link rel="stylesheet" href="../libs/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="layout/default.css">
    </head>
    <body role="document">
        <?php require_once 'layout/cabecalho.php';?>
        
        <div class="container">
        
            <div class="page-header">
                <h1>Usuários</h1>
            </div>
            
            <div class="panel panel-default">
                <div class="panel-body">
                    
                    <form name="frmManutUsuario" id="frmManutUsuario" method="post" action="manut_usuario.php" class="form">
                        
                        <div class="form-group">
                            <label for="txtNome">Nome</label>
                            <input type="text" name="txtNome" id="txtNome" class="form-control input-md" />
                        </div>
                        
                        <div class="form-group">
                            <label for="txtDtNasc">Data de Nascimento</label>
                            <input type="date" name="txtDtNasc" id="txtDtNasc" class="form-control input-md"/>
                        </div>
                        
                        <div class="form-group">
                            <label for="cmbSexo">Sexo</label>
                            <select class="form-control input-md" id="cmbSexo" name="cmbSexo">
                                <option value="M">Masculino</option>
                                <option value="F">Feminino</option>
                            </select>
                        </div>
                        
                 
                        
                        
                    </form>                    
                    
                    
                </div>                
            </div>
            
        </div>
        
        
        
    </body>
    <script type="text/javascript" src="../libs/jquery-1.11.1.min.js" ></script>
    <script type="text/javascript" src="../libs/bootstrap/js/bootstrap.min.js"></script>
</html>
