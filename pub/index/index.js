$(document).ready(function(){
    $("[data-toggle=menulateral]").click(function(){
        $('.sidebar').toggleClass('active');
    });    
    $('.nav-sidebar li a').click(handleTopicoClick);
    $('#btnEditar').click(handleEditarClick);
    
    $('.btn-config').click(abrirOrdemTopico);
    
    $('.nav-sidebar').sortable({
        update: function(event, ui) {
            alert($(this).sortable('serialize'));
            $.post('/pub/index/index.php', $(this).sortable('serialize'))
                .done(function(e) {
                    alert(e)
                });
            
        }
    });
});

function abrirOrdemTopico(){
    $(this).closest('a').find('.btn-group').removeClass('hidden');
    $(this).addClass('hidden');
}

function handleEditarClick(e){
    e.preventDefault();
    $('#editarTopico').modal();
}

function handleTopicoClick(e){
    e.preventDefault();
    $('.nav-sidebar li').removeClass('active');
    $(this).closest('li').addClass('active');
    $('.main').load($(this).attr('href')+' #topicoConteudo',function(){
        $('#btnEditar').click(handleEditarClick);
    });
    
}