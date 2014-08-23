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
        <div class="container">
        
            <div class="page-header">
                <h1>Usuário</h1>
            </div>         
            
            <?php require_once 'layout/mensagens.php'; ?>
            
            
            <!-- Linha para o formulario de cadastro -->
            <div class="row">
                <div class="col-lg-12">
                    <form name="frmManutUsuario" id="frmManutUsuario" method="post" action="cadastro_usuario.php" class="form">
                        <input type="hidden" name="acao" value="gravar" />
                        <input type="hidden" name="codigo" />
                            
                            <div class="col-lg-8 form-group">
                                <label for="txtNome">Nome</label>
                                <input type="text" name="txtNome" id="txtNome" class="form-control input-md" autofocus="true"/>
                            </div>

                            <div class="col-lg-4 form-group">
                                <label for="txtDtNasc">Data de Nascimento</label>
                                <input type="date" name="txtDtNasc" id="txtDtNasc" class="form-control input-md"/>
                            </div>

                            <div class="col-lg-4 form-group">
                                <label for="cmbEstado">Estado</label>
                                <select class="form-control input-lg" id="cmbEstado" name="cmbEstado">
                                    <option value="">-- Selecione --</option>
                                    <?php foreach($estados as $est) : ?>
                                    <option value="<?php echo $est->Codigo; ?>"  <?php echo (($est->Codigo == $estUsu) ? "selected='selected'" : "") ?>><?php echo $est; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="col-lg-4 form-group">
                                <label for="cmbCidade">Cidade</label>
                                <select class="form-control input-lg" id="cmbCidade" name="cmbCidade">
                                    <?php echo $cidades; ?>
                                </select>
                            </div>

                            <div class="col-lg-4 form-group">
                                <label for="cmbSexo">Sexo</label>
                                <select class="form-control input-lg" id="cmbSexo" name="cmbSexo">
                                    <option value="M" <?php echo (($sexo == "M") ? "selected='selected'" : "") ?>>Masculino</option>
                                    <option value="F" <?php echo (($sexo == "F") ? "selected='selected'" : "") ?>>Feminino</option>
                                </select>
                            </div>
                            <div class="col-lg-6 form-group">
                                <label for="txtEmail">Email</label>
                                <input type="text" name="txtEmail" id="txtEmail" class="form-control input-md" />         
                            </div>
                            <div class="col-lg-6 form-group">
                                <label for="txtLogin">Login</label>
                                <input type="text" name="txtLogin" id="txtLogin" class="form-control input-md"  />
                            </div>
                            
                        <!-- Controles do formulario -->
                        <div class="form-inline pull-right">
                            <a class="btn btn-default btn-md" href="lista_usuario.php">Cancelar</a>
                            <button class="btn btn-default btn-md" type="reset">Limpar</button>
                            <button class="btn btn-primary btn-md" type="submit">Salvar</button>
                        </div>

                    </form>                    
                </div> <!-- col que envolve o formulario inteiro -->
            </div> <!-- /row (fim da linha para o formulario de cadastro) -->
                 
            
        </div> <!-- /container -->
        
    </body>
    <script type="text/javascript" src="../libs/jquery-1.11.1.min.js" ></script>
    <script type="text/javascript" src="../libs/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="manut_usuario.js"></script>
    <script type="text/javascript" src="layout/default.js"></script>
</html>

