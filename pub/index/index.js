$(document).ready(function(){
    $("[data-toggle=menulateral]").click(function(){
        $('.sidebar').toggleClass('active');
    });    
    $('.nav-sidebar li a').click(handleTopicoClick);
});


function handleTopicoClick(e){
    e.preventDefault();
    
    $(this).closest('li').addClass('active');
    
    $.get(
        $(this).attr('href'),
        function(ret){
            $('#tituloTopico').html(ret.titulo);
            $('#conteudoTopico').html(ret.conteudo);
        },
        'json'
    );
    
    
}