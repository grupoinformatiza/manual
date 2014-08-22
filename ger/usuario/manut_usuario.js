$(function(){
    $('#cmbEstado').change(carregarCidades);
    $('#frmManutUsuario').submit(validaUsuario);
});

function validaUsuario(e){
    if($('#txtNome').val() == ''){
        $('#txtNome').attr('placeholder','preencha o nome');
        $('#txtNome').parent('.form-group').addClass('has-error');
        e.preventDefault();
    }else{
        $('#txtNome').parent('.form-group').removeClass('has-error');
    }
}

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