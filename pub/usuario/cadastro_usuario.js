$(function(){
    $('#cmbEstado').change(carregarCidades);
    $('#frmManutUsuario').submit(validaUsuario);
});

function validaUsuario(e){
    
    if(!validarCampos('txtNome,txtDtNasc,estado,cmbCidade,cmbSexo,txtEmail,txtLogin,txtSenha'))
        e.preventDefault();  
}

function carregarCidades(){
    var est = $('#cmbEstado').val();
    
    if(est != ''){
        $.post(
            'cadastro_usuario.php',
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