<?php

    require_once '../../config.php';
    use Servico\EstadoDAO;
    use Servico\CidadeDAO;
    
    $log = $_SESSION['web']['usuario'];
    
    if(isset($_POST['acao'])){
        switch($_POST['acao']){
            case 'alterarSenha':
                try{
                    \Servico\UsuarioDAO::alterarSenha($_POST['txtAlSenhaAtual'], $_POST['txtAlNovaSenha']);
                    $ret['status'] = true;
                } catch (Exception $ex) {
                    $ret['status'] = false;
                    $ret['msg'] = $ex->getMessage();
                }
                die(json_encode($ret));
            break;
            case 'carregarCidades':
                $opt = CidadeDAO::getComboCidade($_POST['estado']);
                die($opt); //Retornando as opções para o javascript
                break;
            case 'gravar':
                
                try{
                    $cidade  = CidadeDAO::carregarCidade($_POST['cmbCidade']);
                    $usuario = new Entidade\Usuario();
                    

                    if(isset($_POST['codigo']) && $_POST['codigo'] != 0){
                        $usuario->Codigo = $_POST['codigo'];
                    }else{
                        $usuario->Senha = $_POST['txtSenha'];
                         $usuario->Email = $_POST['txtEmail'];
                        $usuario->Login = $_POST['txtLogin'];
                    }
                    $usuario->Nome = $_POST['txtNome'];
                    $usuario->DataNascimento = $_POST['txtDtNasc'];
                    $usuario->Cidade = $cidade;
                    $usuario->Sexo = $_POST['cmbSexo'];
                   
                    
                    Servico\UsuarioDAO::gravar($usuario);
                    $sucesso = urlencode("Usuário gravado com sucesso!");
                    header("Location: lista_usuario.php?msg=".$sucesso);
                } catch (Exception $ex) {
                    $erro = $ex->getMessage();
                }
                
                break;
            case 'validarLogin':
                
                try{
                    \Servico\UsuarioDAO::validaLogin($_POST['login']);
                    $ret['loginExiste'] = false;
                } catch (Exception $ex) {
                    $ret['loginExiste'] = true;
                }
                die(json_encode($ret));
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
                    
                    if($log->Codigo == $codigo){
                        $usuario = \Servico\UsuarioDAO::getUsuario($codigo);

                        $nome = $usuario->Nome;
                        $sexo = $usuario->Sexo;
                        $login = $usuario->Login;
                        $email = $usuario->Email;
                        $dtNasc = $usuario->DataNascimento;
                        $estUsu = $usuario->Cidade->Estado->Codigo;
                        $cidades = CidadeDAO::getComboCidade($estUsu,$usuario->Cidade->Codigo);
                    }else{
                        $erro = urlencode("Sem permissão para edição");
                        header("Location: lista_usuario.php?erro=$erro");
                    }
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
            
            <?php require_once '../layout/mensagens.php'; ?>
            
            
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
                                    <input type="text" name="txtNome" id="txtNome" class="form-control input-md" autofocus="true" value="<?php echo $nome;?>" />
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
                        <?php if(!isset($_GET['codigo'])) : ?>
                            <fieldset class="panel panel-info">
                                <div class="panel-heading">Dados para Acesso</div>
                                <div class="panel-body">
                                    <div class="col-md-5 form-group">
                                        <label for="txtEmail">Email</label>
                                        <input type="text" name="txtEmail" id="txtEmail" class="form-control input-md" value="<?php echo $email; ?>" />

                                    </div>

                                    <div class="col-md-4 form-group">
                                        <label for="txtLogin">Login</label>
                                        <input type="text" name="txtLogin" id="txtLogin" class="form-control input-md" value="<?php echo $login; ?>" />
                                    </div>

                                    <div class="col-md-3 form-group">
                                        <label for="txtSenha">Senha</label>
                                        <input type="password" name="txtSenha" id="txtSenha" class="form-control input-md" />
                                    </div>

                                </div>
                            </fieldset> <!-- /fieldset dados para acesso -->
                        <?php endif; ?>

                        <!-- Controles do formulario -->
                        <div class="form-inline pull-right">
                            <button class="btn btn-primary btn-md" type="submit">Salvar</button>
                            <a class="btn btn-default btn-md" href="lista_usuario.php">Cancelar</a>
                            
                        </div>

                    </form>                    
                </div> <!-- col que envolve o formulario inteiro -->
            </div> <!-- /row (fim da linha para o formulario de cadastro) -->
                 
            
        </div> <!-- /container -->
        
    </body>
    <script type="text/javascript" src="../../libs/jquery-1.11.1.min.js" ></script>
    <script type="text/javascript" src="../../libs/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../layout/default.js"></script>
    <script type="text/javascript" src="validacao_login.js"></script>
    <script type="text/javascript" src="validacao_email.js"></script>
    <script type="text/javascript" src="../../validacao_data.js"></script>
    <script type="text/javascript" src="manut_usuario.js"></script>
    
    
</html>
