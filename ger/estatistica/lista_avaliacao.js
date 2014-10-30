$(document).ready(function(){   
    $('.coment').click(handleEditarClick);
    $('#comentarios').on('hidden.bs.modal', function() {
        $(this).removeData('bs.modal');
    });
});

function handleEditarClick(e){
    e.preventDefault();
    $('#comentarios').modal({
        remote:$(this).attr("href")
    });
    
}
