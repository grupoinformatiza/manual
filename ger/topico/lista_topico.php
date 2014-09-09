<?php
require_once '../../config.php';
    if (isset($_GET['acao'])){        
        switch($_GET['acao']){
            case 'deletar':
                $codigo = $_GET['codigo'];
                try{
                    Servico\TopicoDAO::deletarTopico($codigo);
                    $sucesso = "Tópico deletado com sucesso";
                } catch (Exception $ex) {
                    $erro = $ex->getMessage();
                }
            break;
            case 'pesquisa':
                $titulo = $_GET['txtPesquisarTopico'];
                try{
                    $pgControllerTop = \Servico\TopicoDAO::listarPaginacao($titulo);
                } catch (Exception $ex) {
                    $erro = $ex->getMessage();
                }     
                break;
                    
        }        
    }
    //fazer o get post pra carregar os topicos qdo mudar o combo
    //listando tutoriais para o campo de pesquisa por tutorial    
    if(!isset($pgControllerTop))
        $pgControllerTop = Servico\TopicoDAO::listarPaginacao();
    $tutoriais = Servico\TutorialDAO::listarTutoriais();
    
?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Cadastrar Tópico</title>
        <link rel="stylesheet" href="../../libs/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="../layout/default.css">
    </head>
    <body role="document">
        <?php require_once '../layout/cabecalho.php';?>
        
        <div class="container">
        
            <div class="page-header">
                <h1>Tópicos</h1>
            </div>
            
            
            
            <!-- Linha para novo e busca -->
            <div class="row">
                <div class="col-md-1 form-group">
                    <a href="manut_topico.php?acao=novo" class="btn btn-success btn-md">
                        <span class="glyphicon glyphicon-plus"></span> Novo
                    </a>
                </div>
             
            
                
                <form method="get" name="frmBuscarTopico" id="frmBuscarTopico" action="lista_topico.php">   
                    <input type="hidden" name="acao" value="pesquisa" />
                    <div class="col-md-4 form-group">
                        <div class="input-group">
                            <input type="text" name="txtPesquisarTopico" id="txtPesquisarTopico" class="form-control input-md" placeholder="Procurar tópicos..."/>
                            <span class="input-group-btn">
                                <button class="btn btn-md btn-default" type="submit">
                                    <span class="glyphicon glyphicon-search"></span>
                                </button>
                            </span>
                        </div>                   

                    </div> 
                    <div class="col-md-4 form-group">
                        <select class="form-control input-md" id="cmbTutorial" name="cmbTutorial">
                            <option value="1">-- Selecione --</option>
                            <?php foreach($tutoriais as $tut) : ?>
                                <option value="<?php echo $tut->Codigo; ?>" ><?php echo $tut->Nome . ' ('.$tut->TipoDescricao.')' ?></option>
                            <?php endforeach; ?>                         
                        </select>
                    </div>
                </form>
            </div> <!--/row(fim da linha para busca e novo)-->
            
            <!-- Linha para tabela -->
            <div class="row">
                <div class="col-md-12">
                    <?php $pgControllerTop->pag->printResultBar(); ?>
                    <?php require_once '../layout/mensagens.php'; ?>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead> 
                                <tr>
                                    <td>Código</td>
                                    <td>Título</td>
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($pgControllerTop->res as $top) : ?>
                                <tr>
                                    <td><?php echo $top->Codigo; ?></td>
                                    <td><?php echo $top->Titulo; ?></td>
                                    <td class="text-right">                                                                                                                
                                        <a href="manut_topico.php?acao=editar&codigo=<?php echo $top->Codigo; ?>" class="btn btn-warning btn-xs">
                                            <span class="glyphicon glyphicon-pencil"></span>
                                        </a>
                                        <a href="lista_topico.php?acao=deletar&codigo=<?php echo $top->Codigo; ?>" class="btn btn-danger btn-xs btn-deletar">
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
            <?php $pgControllerTop->pag->printNavigationBar(); ?>            
        </div> <!-- container -->
    </body>
    <script type="text/javascript" src="../../libs/jquery-1.11.1.min.js" ></script>
    <script type="text/javascript" src="../../libs/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../layout/default.js"></script>  
</html>

