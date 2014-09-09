$(document).ready(function(){
    $("[data-toggle=menulateral]").click(function(){
        $('.sidebar').toggleClass('active');
    });    
    $('.nav-sidebar li a').click(handleTopicoClick);
    $('#btnEditar').click(handleEditarClick);
    
    $('.btn-config').click(abrirOrdemTopico);
    $('.btn-canc').click(fecharOrdemTopico);
    $('.btn-salva').click(salvarOrdemTopico);
//    $('.nav-sidebar').sortable({
//        update: function(event, ui) {
//            alert($(this).sortable('serialize'));
//            $.post('/pub/index/index.php', $(this).sortable('serialize'))
//                .done(function(e) {
//                    alert(e)
//                });
//            
//        }
//    });
});

function abrirOrdemTopico(){
    $(this).closest('a').find('.btn-group').removeClass('hidden');
    $('.btn-config').addClass('hidden');
    $(this).closest('ul').find('.nav-item span').removeClass('hidden');
    if($(this).closest('ul').hasClass('ui-sortable'))
        $(this).closest('ul').sortable('enable');
    else
        $(this).closest('ul').sortable();
}
function fecharOrdemTopico(){
    $('.btn-config').removeClass('hidden');
    $(this).closest('.btn-group').addClass('hidden');
    $(this).closest('ul').find('.nav-item span').addClass('hidden');
    $(this).closest('ul').sortable('disable');
}
function salvarOrdemTopico(){
    
}

function handleEditarClick(e){
    e.preventDefault();
    $('#editarTopico').modal({
        remote:$(this).attr("href")
    });
}

function handleTopicoClick(e){
    e.preventDefault();
    $('.nav-sidebar li').removeClass('active');
    $(this).closest('li').addClass('active');
    $('.main').load($(this).attr('href')+' #topicoConteudo',function(){
        $('#btnEditar').click(handleEditarClick);
    });
    
}
