$(function(){
    $('#cmbEstado').change(carregarCidades);
    $('#frmManutUsuario').submit(validaUsuario);
    $('#txtLogin').blur(
        function(){
            validarLogin($(this),'../../ger/usuario/');
        }
    );
    $('#txtSenhaConf').blur(validarSenha);
});

function validarSenha(){
    var senha = $('#txtSenha');
    var conf  = $('#txtSenhaConf');
    
    if(senha.val() == ''){
        setWarningCampo(senha,'Informe a senha');
        return false;
    }else{
        removeErroCampo(senha);
        if(senha.val() != conf.val()){
            setFatalErrorCampo(conf,'As senhas não conferem')
            return false;
        }else{
            setSucessCampo(conf);
        }
    }
    
    return true;
}

function validaUsuario(e){
    validarSenha();
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