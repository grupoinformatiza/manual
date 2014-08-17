<?php
    require_once '../../config.php';
    
    
    if(isset($_GET['acao'])){
        switch($_GET['acao']){
            case 'deletar':
                
                $codigo = $_GET['codigo'];
                
                try{
                    Servico\UsuarioDAO::deletarUsuario($codigo);
                    $sucesso = "Usuário deletado com sucesso";
                } catch (Exception $ex) {
                    $erro = $ex->getMessage();
                }
                
                break;
            case 'pesquisa':
                
                $nome = $_GET['txtPesquisarUsuario'];
                
                try{
                    $pgControllerUsu = \Servico\UsuarioDAO::listarPorNome($nome);
                } catch (Exception $ex) {
                    $erro = $ex->getMessage();
                }
                
                
                break;
            
        }
    }
    if(!isset($pgControllerUsu))
        $pgControllerUsu = \Servico\UsuarioDAO::listar();
?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Usuários</title>
        <link rel="stylesheet" href="../../libs/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="../layout/default.css">
    </head>
    <body role="document">
        <?php require_once '../layout/cabecalho.php';?>
        
        <div class="container">
        
            <div class="page-header">
                <h1>Usuários</h1>
            </div>
            
            <?php require_once '../layout/mensagens.php'; ?>
            
            <!-- Linha para novo e busca -->
            <div class="row">
                <div class="col-md-1 form-group">
                    <a href="manut_usuario.php?acao=novo" class="btn btn-success btn-md">
                        <span class="glyphicon glyphicon-plus"></span> Novo
                    </a>
                </div>
                <form method="get" name="frmBuscarUsuario" id="frmBuscarUsuario" action="lista_usuario.php">
                    <input type="hidden" name="acao" value="pesquisa" />
                    <div class="col-md-4 form-group">
                        <div class="input-group">
                            <input type="text" name="txtPesquisarUsuario" id="txtPesquisarUsuario" class="form-control input-md" placeholder="Procurar usuários..."/>
                            <span class="input-group-btn">
                                <button class="btn btn-md btn-default" type="submit">
                                    <span class="glyphicon glyphicon-search"></span>
                                </button>
                            </span>
                        </div>

                    </div>        
                </form>
            </div>
            <!-- Linha para tabela -->
            <div class="row">
                <div class="col-md-12">
                    <?php $pgControllerUsu->pag->printResultBar(); ?>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead> 
                                <tr>
                                    <td>Código</td>
                                    <td>Nome</td>
                                    <td>E-mail</td>
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($pgControllerUsu->res as $usu) : ?>
                                <tr>
                                    <td><?php echo $usu->Codigo; ?></td>
                                    <td><?php echo $usu->Nome; ?></td>
                                    <td><?php echo $usu->Email; ?></td>
                                    <td class="text-right">  
                                        <a href="manut_usuario.php?acao=editar&codigo=<?php echo $usu->Codigo; ?>" class="btn btn-warning btn-xs">
                                            <span class="glyphicon glyphicon-pencil"></span>
                                        </a>
                                        <a href="lista_usuario.php?acao=deletar&codigo=<?php echo $usu->Codigo; ?>" class="btn btn-danger btn-xs btn-deletar">
                                            <span class="glyphicon glyphicon-remove"></span>
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div> <!-- table responsive -->
                </div> <!-- col que envolve tabela -->
            </div> <!--/row (fim da linha para a tabela de cadastro)-->
            
            <!-- Linha da paginação -->
            <?php $pgControllerUsu->pag->printNavigationBar(); ?>
            
        </div> <!-- container -->
        
    </body>
    <script type="text/javascript" src="../../libs/jquery-1.11.1.min.js" ></script>
    <script type="text/javascript" src="../../libs/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../layout/default.js"></script>    
</html>
