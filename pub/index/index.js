$(document).ready(function(){
    $("[data-toggle=menulateral]").click(function(){
        $('.sidebar').toggleClass('active');
    });    
    $('.nav-sidebar li a').click(handleTopicoClick);
    $('#btnEditar').click(handleEditarClick);
});

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