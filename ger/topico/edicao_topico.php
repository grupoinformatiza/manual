<?php
    require_once '../../config.php';
    $titulo=null;
    $conteudo=null;
    if (isset($_GET['acao'])){        
        switch($_GET['acao']){
            case 'editar':
                try{
                    $codigo = $_GET['codigo'];
                    $topico = \Servico\TopicoDAO::getTopico($codigo);                                 
                    $titulo = $topico->Titulo;
                    $conteudo = $topico->Conteudo;
                }catch(Exception $ex){
                    $erro = $ex->getMessage();
                }
                break;        
        }
    }
    if (isset($_POST['acao'])){
        switch($_POST['acao']){
            case 'gravar':
                try{
                    $topico = new Entidade\Topico();
                    if(isset($_POST['codigo']) && $_POST['codigo'] != 0)
                        $topico  = \Servico\TopicoDAO::getTopico($_POST['codigo']);
                    $topico->Titulo = $_POST['txtTitulo'];
                    $topico->Conteudo = $_POST['txtConteudo'];
                    Servico\TopicoDAO::gravar($topico);
                    $ret['status'] = true;
                } catch (Exception $ex) {
                    $ret['erro'] = $ex->getMessage();
                    $ret['status'] = false;
                    
                }
                die(json_encode($ret));
                break;       
        }        
    }
    
?>
<link rel="stylesheet" href="../../libs/summernote/font-awesome.min.css">
<link rel="stylesheet" href="../../libs/summernote/summernote.css">
<div class="modal-header">
    <h4 class="modal-title">Editar Tópico
        <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">×</span>
            <span class="sr-only">Fechar</span>
        </button>
    </h4>
</div>
<form name="frmEdicaoTopico" id="frmEdicaoTopico" class="modal-form" action="../../ger/topico/edicao_topico.php" method="post">
    <input type="hidden" name="acao" value="gravar" />
    <input type="hidden" name="codigo" value="<?php echo (int)$_GET['codigo']; ?>" />
    <div class="modal-body">
            <div class="msgPlaceholder"></div>
            <div class="form-group">
                <label for="txtTitulo">Título</label>
                <input type="text" name="txtTitulo" id="txtTitulo" class="form-control input-md" value="<?php echo $titulo; ?>"/> 
            </div>
 
            <div class="form-group">
                <label for="txtConteudo">Conteúdo</label>
                <textarea type="text" name="txtConteudo" id="txtConteudo" rows="10" class="form-control input-md"> <?php echo $conteudo; ?> </textarea>
            </div>        

    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-default btn-md" data-dismiss="modal">Descartar Alterações</button>
        <button type="submit" class="btn btn-primary btn-md"><span class="glyphicon glyphicon-floppy-disk"></span> Salvar</button>
    </div>
</form>
<script type="text/javascript" src="../../libs/summernote/summernote.min.js"></script>
<script type="text/javascript" src="../../libs/lang/summernote-pt-BR.js"></script>
<script type="text/javascript" src="../../ger/topico/edicao_topico.js"></script>