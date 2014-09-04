<?php

    require_once '../../config.php';
    use Servico\EstadoDAO;
    use Servico\CidadeDAO;
    
    if(isset($_POST['acao'])){
        switch($_POST['acao']){
            case 'carregarCidades':
                $opt = CidadeDAO::getComboCidade($_POST['estado']);
                die($opt); //Retornando as opções para o javascript
                break;
            case 'gravar':
                
                try{
                    $cidade  = CidadeDAO::carregarCidade($_POST['cmbCidade']);
                    $usuario = new Entidade\Usuario();
                    

                    if(isset($_POST['codigo']) && $_POST['codigo'] != 0)
                        $usuario->Codigo = $_POST['codigo'];
                    else
                        $usuario->Senha = $_POST['txtSenha'];
                    
                    $usuario->Nome = $_POST['txtNome'];
                    $usuario->DataNascimento = $_POST['txtDtNasc'];
                    $usuario->Cidade = $cidade;
                    $usuario->Sexo = $_POST['cmbSexo'];
                    $usuario->Email = $_POST['txtEmail'];
                    $usuario->Login = $_POST['txtLogin'];
                    
                    Servico\UsuarioDAO::gravar($usuario);
                    $sucesso = "Usuário gravado com sucesso!";
                    
                } catch (Exception $ex) {
                    $erro = $ex->getMessage();
                }
                
                break;
        }
    }
    $estados = EstadoDAO::listarEstados();
?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Cadastrar Usuários</title>
        <link rel="stylesheet" href="../../libs/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="../../default.css" />
        <link rel="stylesheet" href="cadastro_usuario.css" />
        
    </head>
    <body role="document">
        <?php require_once '../layout/cabecalho.php';?>
        
        <div class="container">
            <div class="row">          
                <!-- Linha para o formulario de cadastro -->
                <div class="col-lg-6 col-xs-12 col-lg-offset-3">
                    <?php require_once '../../ger/layout/mensagens.php'; ?>
                    <h1>Inscreva-se</h1>
                    
                    <form name="frmManutUsuario" id="frmManutUsuario" method="post" action="cadastro_usuario.php" class="form">
                        <input type="hidden" name="acao" value="gravar" />
                        <input type="hidden" name="codigo" />
                            <fieldset class="panel panel-default">
                                <div class="panel-body">
                                    <div class="col-lg-9 col-xs-9 form-group">
                                        <label for="txtNome">Nome</label>
                                        <input type="text" name="txtNome" id="txtNome" class="form-control input-lg" autofocus="true"/>
                                    </div>

                                    <div class="col-lg-3 col-xs-3 form-group">
                                        <label for="cmbSexo">Sexo</label>
                                        <select class="form-control input-lg" id="cmbSexo" name="cmbSexo">
                                            <option value=""> --</option>
                                            <option value="M">M</option>
                                            <option value="F">F</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-3 col-xs-3 form-group">
                                        <label for="cmbEstado">Estado</label>
                                        <select class="form-control input-lg" id="cmbEstado" name="cmbEstado">
                                            <option value=""> --</option>
                                            <?php foreach($estados as $est) : ?>
                                            <option value="<?php echo $est->Codigo; ?>"><?php echo $est->Sigla; ?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>

                                    <div class="col-lg-9 col-xs-9 form-group">
                                        <label for="cmbCidade">Cidade</label>
                                        <select class="form-control input-lg" id="cmbCidade" name="cmbCidade">
                                            <option value="">-- Selecione --</option>
                                            <?php echo $cidades; ?>
                                        </select>
                                    </div>
                                    <div class="col-xs-6 col-lg-6 form-group">
                                        <label for="txtEmail">Email</label>
                                        <input type="text" name="txtEmail" id="txtEmail" class="form-control input-lg" />         
                                    </div>
                                    <div class="col-lg-6 col-xs-6 form-group">
                                        <label for="txtDtNasc">Data de Nascimento</label>
                                        <input type="date" name="txtDtNasc" id="txtDtNasc" class="form-control input-lg"/>
                                    </div>
                                    <div class="col-lg-12 col-xs-12 form-group">
                                        <label for="txtLogin">Login</label>
                                        <input type="text" name="txtLogin" id="txtLogin" class="form-control input-lg"  />
                                    </div>
                                     <div class="col-lg-6 col-xs-6 form-group">
                                        <label for="txtSenha">Senha</label>
                                        <input type="password" name="txtSenha" id="txtSenha" class="form-control input-lg"  />
                                    </div>
                                    <div class="col-lg-6 col-xs-6 form-group">
                                        <label for="txtSenhaConf">Confirmar Senha</label>
                                        <input type="password" name="txtSenhaConf" id="txtSenhaConf" class="form-control input-lg"  />
                                    </div>
                                </div>    
                            </fieldset>
                       
                            <!-- Controles do formulario -->
                            <div>
                                
                                    <button class="btn btn-primary btn-lg btn-block" type="submit">Confirmar</button>
                                
                            </div>
                     

                    </form>                    
                </div> <!-- col que envolve o formulario inteiro -->
            </div>
                 
            
        </div> <!-- /container -->
        
    </body>
    <script type="text/javascript" src="../../libs/jquery-1.11.1.min.js" ></script>
    <script type="text/javascript" src="../../libs/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../../ger/layout/default.js"></script>
    <script type="text/javascript" src="../../ger/usuario/validacao_login.js"></script>
    <script type="text/javascript" src="cadastro_usuario.js"></script>
    
    
</html>

