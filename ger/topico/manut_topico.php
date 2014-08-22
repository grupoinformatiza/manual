<?php
    require_once '../../config.php';
    
    $titulo= null;
    $IDtutorial= null;
    $conteudo= null;
    if(isset($_POST['acao'])){
        switch($_POST['acao']){
            case 'gravar':
                
                try{
                    $topico = new Entidade\Topico();
                    $topico->Titulo = $_POST['txtTitulo'];
                    $topico->Conteudo = $_POST['txtConteudo'];
                    $topico->Tutorial = $_POST['cmbTutorial']; 
                    Servico\TopicoDAO::gravar($topico);
                    $sucesso = "Tópico gravado com sucesso!";
                } catch (Exception $ex) {
                    $erro = $ex->getMessage();
                }
                
                break;
            
            
                   
        }
    }
    if(isset($_GET['acao'])){
        switch($_GET['acao']){
            case 'editar':                
                try{
                    $codigo = $_GET['codigo'];  
                    
                    $topico = \Servico\TopicoDAO::getTopico($codigo);
                                  
                    $titulo = $topico->Titulo;
                    $conteudo = $topico->Conteudo;
                    $IDtutorial = $topico->Tutorial->Codigo;
                }catch(Exception $ex){
                    $erro = $ex->getMessage();
                }               
                break;    
        }
    }
   
    $comboTutorial = Servico\TutorialDAO::listar();
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
                <h1>Tópico</h1>
            </div>
            
            <?php require_once '../layout/mensagens.php'; ?>
           
            <form name="frmManutTopico" id="frmManutTopico" class="form" action="manut_topico.php" method="post">
                <input type="hidden" name="acao" value="gravar" />
                <input type="hidden" name="codigo" value="<?php echo (int)$_GET['codigo']; ?>" />
                <div class="panel panel-info">
                    <div class="panel-body">
                        <div class="col-md-9 form-group">
                            <label for="txtTitulo">Título</label>
                            <input type="text" name="txtTitulo" id="txtTitulo" class="form-control input-md" autofocus="true" value="<?php echo $titulo;?>"/>
                        </div>
                        
                        <!-- Combo carregado com os tutoriais disponíveis -->
                        <div class="col-md-3 form-group">
                            <label for="cmbTutorial">Tutorial</label>
                            <select class="form-control input-md" id="cmbTutorial" name="cmbTutorial">
                                <option value="1">-- Selecione --</option>
                                <?php foreach($tutoriais as $tut) : ?>
                                <option value="<?php echo $tut->Codigo; ?>" <?php echo (($tut->Codigo == $IDtutorial) ? "selected='selected'" : "") ?>><?php echo $tut->Nome; ?></option>
                                <?php endforeach; ?>                                
                            </select>
                        </div>
                        
                        <div class="col-md-12 form-group">
                            <label for="txtConteudo">Conteúdo</label>
                            <textarea type="text" name="txtConteudo" id="txtConteudo" class="form-control" value="<?php echo $conteudo;?>"></textarea>
                        </div>
                    </div> <!-- /painel body(corpo do painel) -->
                </div> <!-- fim do painel -->
                <!-- Controles do formulario -->
                <div class="form-inline pull-right">
                    <a class="btn btn-default btn-md" href="lista_topico.php">Cancelar</a>
                    <button class="btn btn-default btn-md" type="reset">Limpar</button>
                    <button class="btn btn-primary btn-md" type="submit">Salvar</button>
                </div>
            </form>
        </div> <!-- /container -->
        
        

    </body>
    <script type="text/javascript" src="../../libs/jquery-1.11.1.min.js" ></script>
    <script type="text/javascript" src="../../libs/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../layout/default.js"></script>
</html>

