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
                    
                    $usuario->Nome = $_POST['txtNome'];
                    $usuario->DataNascimento = $_POST['txtDtNasc'];
                    $usuario->Cidade = $cidade;
                    $usuario->Sexo = $_POST['cmbSexo'];
                    $usuario->Email = $_POST['txtEmail'];
                    $usuario->Login = $_POST['txtLogin'];
                    Servico\UsuarioDAO::gravar($usuario);
                    $sucesso = "Usuário gravado com sucesso! <a href='lista_usuario.php'class='alert-link'>Voltar para a lista</a>";
                } catch (Exception $ex) {
                    $erro = $ex->getMessage();
                }
                
                break;
        }
    }
    
    $nome = null;
    $sexo = null;
    $login = null;
    $email = null;
    $dtNasc = null;
    $estUsu = null;
    $cidades = null;
    
    if(isset($_GET['acao'])){        
        switch($_GET['acao']){
            case 'editar':
                try{
                    $codigo = $_GET['codigo'];
                
                    $usuario = \Servico\UsuarioDAO::getUsuario($codigo);
                    
                    $nome = $usuario->Nome;
                    $sexo = $usuario->Sexo;
                    $login = $usuario->Login;
                    $email = $usuario->Email;
                    $dtNasc = $usuario->DataNascimento;
                    $estUsu = $usuario->Cidade->Estado->Codigo;
                    $cidades = CidadeDAO::getComboCidade($estUsu,$usuario->Cidade->Codigo);
                }catch(Exception $ex){
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
        <link rel="stylesheet" href="../layout/default.css">
    </head>
    <body role="document">
        <?php require_once '../layout/cabecalho.php';?>
        
        <div class="container">
        
            <div class="page-header">
                <h1>Usuário</h1>
            </div>         
            
            <?php if(isset($erro)) : ?>
            
            <div class="alert alert-danger"><?php echo $erro ?></div>
            
            <?php endif ?>
            
            <?php if(isset($sucesso)) : ?>
            
            <div class="alert alert-success"><?php echo $sucesso ?></div>
            
            <?php endif ?>
            
            
            
            <!-- Linha para o formulario de cadastro -->
            <div class="row">
                <div class="col-md-12">
                    <form name="frmManutUsuario" id="frmManutUsuario" method="post" action="manut_usuario.php" class="form">
                        <input type="hidden" name="acao" value="gravar" />
                        <input type="hidden" name="codigo" value="<?php echo (int)$_GET['codigo']; ?>" />
                        <fieldset class="panel panel-info">
                            <div class="panel-heading">Dados Pessoais</div>

                            <div class="panel-body">
                                <div class="col-md-8 form-group">
                                    <label for="txtNome">Nome</label>
                                    <input type="text" name="txtNome" id="txtNome" class="form-control input-md" value="<?php echo $nome;?>" />
                                </div>

                                <div class="col-md-4 form-group">
                                    <label for="txtDtNasc">Data de Nascimento</label>
                                    <input type="date" name="txtDtNasc" id="txtDtNasc" class="form-control input-md" value="<?php echo $dtNasc; ?>"/>
                                </div>

                                <div class="col-md-4 form-group">
                                    <label for="cmbEstado">Estado</label>
                                    <select class="form-control input-md" id="cmbEstado" name="cmbEstado">
                                        <option value="">-- Selecione --</option>
                                        <?php foreach($estados as $est) : ?>
                                        <option value="<?php echo $est->Codigo; ?>"  <?php echo (($est->Codigo == $estUsu) ? "selected='selected'" : "") ?>><?php echo $est; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="col-md-4 form-group">
                                    <label for="cmbCidade">Cidade</label>
                                    <select class="form-control input-md" id="cmbCidade" name="cmbCidade">
                                        <?php echo $cidades; ?>
                                    </select>
                                </div>

                                <div class="col-md-4 form-group">
                                    <label for="cmbSexo">Sexo</label>
                                    <select class="form-control input-md" id="cmbSexo" name="cmbSexo">
                                        <option value="M" <?php echo (($sexo == "M") ? "selected='selected'" : "") ?>>Masculino</option>
                                        <option value="F" <?php echo (($sexo == "F") ? "selected='selected'" : "") ?>>Feminino</option>
                                    </select>
                                </div>
                            </div>
                        </fieldset> <!-- /fieldset dados pessoais -->

                        <fieldset class="panel panel-info">
                            <div class="panel-heading">Dados para Acesso</div>
                            <div class="panel-body">
                                <div class="col-md-6 form-group">
                                    <label for="txtEmail">Email</label>
                                    <input type="text" name="txtEmail" id="txtEmail" class="form-control input-md" value="<?php echo $email; ?>" />
                                    <p class="help-block">Será enviada uma confirmação de cadastro para este email.</p>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="txtLogin">Login</label>
                                    <input type="text" name="txtLogin" id="txtLogin" class="form-control input-md" value="<?php echo $login; ?>" />
                                </div>
                            </div>
                        </fieldset> <!-- /fieldset dados para acesso -->

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
    <script type="text/javascript" src="../../libs/jquery-1.11.1.min.js" ></script>
    <script type="text/javascript" src="../../libs/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="manut_usuario.js"></script>
    <script type="text/javascript" src="layout/default.js"></script>
</html>
