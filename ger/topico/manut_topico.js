$(function(){
    $('#txtConteudo').summernote({
        height: 200,
        tabsize: 2,
        styleWithSpan: false,
        lang:'pt-BR'
      });
    $('#frmManutTopico').submit(validaTopico);
    $('#cmbTutorial').change(setarOrdem);
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

function setarOrdem(){
    var tut = $('#cmbTutorial').val();
    if(tut != ''){
        $.post(
            'manut_topico.php',
            {acao:'setarOrdem',
             ordem:tut
            },
            function(retorno){ //valor do die
                if(retorno)
                    $('#txtOrdem').val(retorno.ordem);
            },
            'json'
        );
    }else{
        $('#txtOrdem').val("");
    }
}
