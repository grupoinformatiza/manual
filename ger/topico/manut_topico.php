<?php
    require_once '../../config.php';
    
    if(isset($_POST['acao'])){
        switch($_POST['acao']){
            case 'gravar':          
                try{
                    $topico = new Entidade\Topico();
                    if(isset($_POST['codigo']) && $_POST['codigo'] != 0)
                        $topico->Codigo = $_POST['codigo'];
                    $topico->Titulo = $_POST['txtTitulo'];
                    $topico->Conteudo = $_POST['txtConteudo'];
                    $topico->Tutorial = Servico\TutorialDAO::getTutorial($_POST['cmbTutorial']);
                    $topico->Ordem = $_POST['txtOrdem'];
                    Servico\TopicoDAO::gravar($topico);
                    $sucesso = "Tópico gravado com sucesso!";
                } catch (Exception $ex) {
                    $erro = $ex->getMessage();
                }
                
                break;
            case 'setarOrdem':
                $erro = "";
                try{                
                    $cod_tutorial = $_POST['ordem'];
                    $proxOrdem = Servico\TopicoDAO::getOrdem($cod_tutorial);
                    
                } catch (Exception $ex) {
                    $erro = $ex->getMessage();
                }
                
                $ret = array(
                    "ordem" => $proxOrdem,
                    "mensagem" => $erro
                );
                die(json_encode($ret)); //json - tipo de dado 
            break;
            
            
                   
        }
    }
    $titulo= null;
    $IDtutorial= null;
    $conteudo= null;
    $ordem=null;
    if(isset($_GET['acao'])){
        switch($_GET['acao']){
            case 'editar':                
                try{
                    $codigo = $_GET['codigo'];  
                    
                    $topico = \Servico\TopicoDAO::getTopico($codigo);
                                  
                    $titulo = $topico->Titulo;
                    $conteudo = $topico->Conteudo;
                    $IDtutorial = $topico->Tutorial->Codigo;
                    $ordem = $topico->Ordem;
                    
                    
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
        <link rel="stylesheet" href="../../libs/summernote/font-awesome.min.css">
        <link rel="stylesheet" href="../../libs/summernote/summernote.css">
        <link rel="stylesheet" href="../layout/default.css">
        
    </head>
    <body role="document">
        <?php require_once '../layout/cabecalho.php';?>
        <div class="container">-->
            <div class="page-header">
                <h1>Tópico</h1>
            </div>
                <a href="lista_topico.php" class="btn btn-success btn-md">
                    <span class="glyphicon glyphicon-arrow-left"></span>  Voltar
                </a>
            <br/>
            <br>
            <?php require_once '../layout/mensagens.php'; ?>
           
            <form name="frmManutTopico" id="frmManutTopico" class="form" action="../../ger/topico/manut_topico.php" method="post">
                <input type="hidden" name="acao" value="gravar" />
                <input type="hidden" name="codigo" value="<?php echo (int)$_GET['codigo']; ?>" />
                <div class="panel panel-info">
                    <div class="panel-body">
                        <div class="col-md-7 form-group">
                            <label for="txtTitulo">Título</label>
                            <input type="text" name="txtTitulo" id="txtTitulo" class="form-control input-md" autofocus="true" value="<?php echo $titulo;?>"/>
                        </div>
                        
                        <!-- Combo carregado com os tutoriais disponíveis -->
                        <div class="col-md-3 form-group">
                            <label for="cmbTutorial">Tutorial</label>
                            <select class="form-control input-md" id="cmbTutorial" name="cmbTutorial">
                                <option value="">-- Selecione --</option>
                                <?php foreach($tutoriais as $tut) : ?>
                                <option value="<?php echo $tut->Codigo; ?>" <?php echo (($tut->Codigo == $IDtutorial) ? "selected='selected'" : "") ?>><?php echo $tut->Nome . ' ('.$tut->TipoDescricao.')'  ?></option>
                                <?php endforeach; ?>                                
                            </select>
                        </div>

                        <div class="col-md-2 form-group">
                            <label for="txtOrdem">Ordem</label>
                            <input type="text" name="txtOrdem" id="txtOrdem" class="form-control input-md" value="<?php echo $ordem;?>" readonly="true"/>
                        </div>
                        
                        <div class="col-md-12 form-group">
                            <label for="txtConteudo">Conteúdo</label>
                            <textarea type="text" name="txtConteudo" id="txtConteudo" rows="13" class="form-control"><?php echo $conteudo;?></textarea>
                        </div>
                    </div> <!-- /painel body(corpo do painel) -->
                </div> <!-- fim do painel -->
                <!-- Controles do formulario -->
                <div class="form-inline pull-right">
                    <button class="btn btn-primary btn-md" type="submit">Salvar</button>
                    <a class="btn btn-default btn-md" href="lista_topico.php">Cancelar</a>
                </div>
            </form>
        </div> <!-- /container -->
        
        

    </body>
    
    
    <script type="text/javascript" src="../../libs/jquery-1.11.1.min.js" ></script>
    <script type="text/javascript" src="../../libs/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../../libs/summernote/summernote.min.js"></script>
    <script type="text/javascript" src="../../libs/lang/summernote-pt-BR.js"></script>
    <script type="text/javascript" src="../layout/default.js"></script>
    <script type="text/javascript" src="manut_topico.js"></script>
</html>

