<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Cadastrar Usuários</title>
        <link rel="stylesheet" href="libs/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="default.css" />
    </head>
    <body role="document">       
        <div class="container">
        
            <div class="page-header">
                <h1>Inscreva-se</h1>
            </div>         
                               
            <!-- Linha para o formulario de cadastro -->
            <div class="col-lg-12">
                <form name="frmManutUsuario" id="frmManutUsuario" method="post" action="cadastro_usuario.php" class="form">
                    <input type="hidden" name="acao" value="gravar" />
                    <input type="hidden" name="codigo" />
                    <div class="col-lg-12">
                        <fieldset class="panel panel-info col-lg-6">
                            <div class="panel-body">
                                <div class="col-lg-12 form-group">
                                    <label for="txtNome">Nome</label>
                                    <input type="text" name="txtNome" id="txtNome" class="form-control input-lg" autofocus="true"/>
                                </div>

                                <div class="col-lg-7 form-group">
                                    <label for="cmbSexo">Sexo</label>
                                    <select class="form-control input-lg" id="cmbSexo" name="cmbSexo">
                                        <option value="M" <?php echo (($sexo == "M") ? "selected='selected'" : "") ?>>Masculino</option>
                                        <option value="F" <?php echo (($sexo == "F") ? "selected='selected'" : "") ?>>Feminino</option>
                                    </select>
                                </div>
                                 <div class="col-lg-5 form-group">
                                    <label for="txtDtNasc">Data de Nascimento</label>
                                    <input type="date" name="txtDtNasc" id="txtDtNasc" class="form-control input-lg"/>
                                </div>
                                <div class="col-lg-12 form-group">
                                    <label for="txtEmail">Email</label>
                                    <input type="text" name="txtEmail" id="txtEmail" class="form-control input-lg" />         
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

                                <div class="col-lg-8 form-group">
                                    <label for="cmbCidade">Cidade</label>
                                    <select class="form-control input-lg" id="cmbCidade" name="cmbCidade">
                                        <?php echo $cidades; ?>
                                    </select>
                                </div>                                
                                <div class="col-lg-12 form-group">
                                    <label for="txtLogin">Login</label>
                                    <input type="text" name="txtLogin" id="txtLogin" class="form-control input-lg"  />
                                </div>
                                <div class="col-lg-12 form-group">
                                    <label for="txtSenha">Senha</label>
                                    <input type="text" name="txtSenha" id="txtSenha" class="form-control input-lg"  />
                                </div>
                            </div>    
                        </fieldset>
                    </div>
                    <div class="row">
                        <!-- Controles do formulario -->
                        <div class="col-lg-6">
                            <div class="form-inline pull-right">
                                <button class="btn btn-primary btn-lg" type="submit">Confirmar</button>
                            </div>
                        </div>
                    </div>

                </form>                    
            </div> <!-- col que envolve o formulario inteiro -->
           
                 
            
        </div> <!-- /container -->
        
    </body>
    <script type="text/javascript" src="../libs/jquery-1.11.1.min.js" ></script>
    <script type="text/javascript" src="../libs/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="manut_usuario.js"></script>
    <script type="text/javascript" src="layout/default.js"></script>
</html>

