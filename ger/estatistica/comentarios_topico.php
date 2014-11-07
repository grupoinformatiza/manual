<?php 
    require_once '../../config.php';
    
    if(isset($_GET['acao']) && $_GET['acao'] == 'exibirComentario'){
        $codigo = $_GET['codigo'];
        try{
            $comentarios = Servico\EstatisticaDAO::listaComentarios($codigo);
        } catch (Exception $ex) {
            $erro = $ex->getMessage();
        }
    }
?>
<div class="modal-header">
    <h4 class="modal-title" id="comentTitulo">Comentários</h4>
    <button type="button" class="close" data-dismiss="modal">
        <span aria-hidden="true">×</span>
        <span class="sr-only">Fechar</span>
    </button>
    
</div>

<form name="frmComentarios" id="frmComentarios" method="post" action="">
        <div class="modal-body">
            <div id="erroPlaceholder"></div>
            <table class="table table-striped">
                <?php foreach($comentarios as $coment) : ?>
                <tr>
                    <div class="form-group">
                        <label for="comentario"><?php echo $coment->Coments; ?></label>
                    </div>
                </tr>
                <?php endforeach; ?>
            </table>    
        </div>
</form>