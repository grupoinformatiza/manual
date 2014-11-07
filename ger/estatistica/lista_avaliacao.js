$(document).ready(function(){   
    $('.coment').click(handleEditarClick);
    $('#comentarios').on('hidden.bs.modal', function() {
        $(this).removeData('bs.modal');
    });
    
    $('.btn-mostraComentario').click(handleEditarClick);
   
});

function handleEditarClick(e){
    e.preventDefault();
    $('#comentarios').modal({
        remote:$(this).attr("href")
    });
    
}
$(function(){
    $('#cmbTutorial').change(listarPorTutorial);
});

function listarPorTutorial(){
    $('#frmBuscarTopico').submit();    
}

