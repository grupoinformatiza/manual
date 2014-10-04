$(document).ready(function(){
    $("[data-toggle=menulateral]").click(function(){
        $('.sidebar').toggleClass('active');
    });    
    $('.nav-sidebar li:not(.nav-header) a').click(handleTopicoClick);
    $('#btnEditar').click(handleEditarClick);
    
    $('.btn-config').click(abrirOrdemTopico);
    $('.btn-canc').click(fecharOrdemTopico);
    $('.btn-salva').click(salvarOrdemTopico);
    $('#editarTopico').on('hidden.bs.modal', function() {
        $(this).removeData('bs.modal');
    });
    $('#editarTopico').on('loaded.bs.modal', function (e) {
        $('#txtConteudo').summernote({
            toolbar:[
                ['style',['style']],
                ['style',['bold','italic','underline']],
                ['insert',['picture','video','hr']],
                ['layout',['ul','ol','paragraph']],
                ['misc',['codeview']]
            ],
            lang:'pt-BR'
        });
        $('#frmEdicaoTopico').submit(handleFormSubmit);
    });
    $('.nav-item').addClass('hidden');
    $('.nav-header').click(toggleItens);
});

function toggleItens(){
    $('.nav-item').addClass('hidden');
    $(this).closest('.nav-sidebar').find('.nav-item').toggleClass('hidden');
}

var cache = '';
function abrirOrdemTopico(){
    cache = $(this).closest('ul').html();
    $(this).closest('a').find('.btn-group').removeClass('hidden');
    $('.btn-config').addClass('hidden');
    $(this).closest('ul').find('.nav-item span').removeClass('hidden');
    if($(this).closest('ul').hasClass('ui-sortable'))
        $(this).closest('ul').sortable('enable');
    else
        $(this).closest('ul').sortable();
}
function fecharOrdemTopico(){
    $(this).closest('ul').html(cache);
    $('.btn-config').removeClass('hidden');
    $(this).closest('.btn-group').addClass('hidden');
    $(this).closest('ul').find('.nav-item span').addClass('hidden');
    $(this).closest('ul').sortable('disable');
}
function salvarOrdemTopico(){
    var nav = $(this).closest('.nav-sidebar');
    $.get(
        'index.php',
        nav.sortable('serialize'),
        function(ret){
            if(ret.status){
                nav.find('.nav-item span').addClass('hidden');
                nav.sortable('disable');
                nav.find('.btn-group').addClass('hidden');
                $('.btn-config').removeClass('hidden');
            }else{
                alert(ret.erro);
            }
        },
        'json'
    );
}

function handleEditarClick(e){
    e.preventDefault();
    $('#editarTopico').modal({
        remote:$(this).attr("href")
    });
    
}

function handleTopicoClick(e){
    e.preventDefault();
    if($('.sidebar').hasClass('active'))
        $('.sidebar').toggleClass('active');
    $('.nav-sidebar li').removeClass('active');
    $(this).closest('li').addClass('active');
    $('.main').load($(this).attr('href'),function(){
        $('#btnEditar').click(handleEditarClick);
    });
    
}
