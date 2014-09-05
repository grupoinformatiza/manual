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

function setarOrdem(){
    var tut = $('#cmbTutorial').val();
    
    if(tut != ''){
        $.post(
            'manut_topico.php',
            {acao:'setarOrdem',
             ordem:tut
            },
            function(retorno){
                if(retorno)
                    $('#txtOrdem').html(retorno);
            },
            'html'
        );
    }else{
        $('#txtOrdem').html("value='<?php echo $ordem; ?>'");
    }
    
}
