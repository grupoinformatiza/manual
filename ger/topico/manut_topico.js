$(function(){
    $('#txtConteudo').wysihtml5({locale:'pt-BR'});
    $('#frmManutTopico').submit(validaTopico);
});

function validaTopico(e){
    
    if(!validarCampos('txtTitulo,txtConteudo,tutorial'))
        e.preventDefault();
    if ($('#filImagem').val() == '')
    {
        e.preventDefault();
        alert("Insira uma imagem");
    }
}