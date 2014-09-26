$(function(){
    $('#cmbEstado').change(carregarCidades);
    $('#frmManutUsuario').submit(validaUsuario);
    $('#txtLogin').blur(function(){
        validarLogin($(this),'');
    });
    $('#txtEmail').blur(function(){
        validarEmail($(this));
    });
});



function validaUsuario(e){
    
    if(!validarCampos('txtNome,txtDtNasc,estado,cmbCidade,cmbSexo,txtEmail,txtLogin,txtSenha'))
        e.preventDefault();  
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
                    $('#cmbTutorial').html(retorno);
            },
            'html'
        );
    }else{
        $('#cmbCidade').html("<option value=''>-- Selecione um Estado --</option>");
    }
    
}