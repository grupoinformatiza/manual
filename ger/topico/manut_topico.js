$(function(){
    $('#txtConteudo').summernote({
        height: 200,
        tabsize: 2,
        styleWithSpan: false,
        lang:'pt-BR'
      });
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
