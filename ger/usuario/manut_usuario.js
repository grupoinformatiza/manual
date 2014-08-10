$(function(){
    $('#cmbEstado').change(carregarCidades);
});

function carregarCidades(){
    var est = $('#cmbEstado').val();
    
    if(est != ''){
        $.post(
            'manut_usuario.php',
            {acao:'carregarCidades',
             estado:est
            },
            function(retorno){
                if(retorno)
                    $('#cmbCidade').html(retorno);
            },
            'html'
        );
    }else{
        $('#cmbCidade').html("<option value=''>-- Selecione um Estado --</option>");
    }
    
}