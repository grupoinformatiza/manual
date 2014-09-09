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
            case 'salvar':
                break;
            case 'edicaoAvan':
                break;            
        }
    }
    if (isset($_POST['acao'])){
        switch($_POST['acao']){
            case 'gravar':
                try{
                    $topico = new Entidade\Topico();
                    if(isset($_POST['codigo']) && $_POST['codigo'] != 0)
                        $topico->Codigo = $_POST['codigo'];
                    $topico->Titulo = $_POST['txtTitulo'];
                    $topico->Conteudo = $_POST['txtConteudo'];
                    Servico\TopicoDAO::gravar($topico);
                    $sucesso = "Tópico gravado com sucesso!";
                } catch (Exception $ex) {
                    $erro = $ex->getMessage();
                }
                break;
            case 'edicaoAvan':
                break;            
        }        
    }
    
?>


<div class="modal-header">
    <h4 class="modal-title">Editar Tópico</h4>
</div>
<form name="frmEdicaoTopico" id="frmEdicaoTopico" class="modal-form" action="../../ger/topico/edicao_topico.php" method="post">
    <input type="hidden" name="acao" value="gravar" />
    <input type="hidden" name="codigo" value="<?php echo (int)$_GET['codigo']; ?>" />
    <div class="modal-body">
            
            <div class="form-group">
                <label for="txtTitulo">Título</label>
                <input type="text" name="txtTituloTopico" id="txtTituloTopico" class="form-control input-md" value="<?php echo $titulo; ?>"/> 
            </div>
 
            <div class="form-group">
                <label for="txtConteudo">Conteúdo</label>
                <textarea type="text" name="txtConteudoTopico" id="txtConteudoTopico" rows="10" class="form-control input-md"> <?php echo $conteudo; ?> </textarea>
            </div>        

    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary btn-md"><span class="glyphicon glyphicon-floppy-disk"></span> Salvar Alterações</button>
    </div>
</form>