$(function(){
    $('#cmbEstado').change(carregarCidades);
    $('#frmManutUsuario').submit(validaUsuario);
    $('#txtLogin').blur(
        function(){
            validarLogin($(this),'../../ger/usuario/');
        }
    );
    $('#txtSenhaConf').blur(validarSenha);
    $('#txtSenha').blur(validarSenha2);
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

function validarSenha2(){
    var senha2 = $('#txtSenha');
    var conf2  = $('#txtSenhaConf'); 

    if((senha2.val() == '')&&(conf2.val() == '')){
        if(conf2.val() == senha2.val()){
            removeErroCampo(senha2);
            removeErroCampo(conf2);
            setSucessCampo(conf2);
        }
        else{
            setFatalErrorCampo(conf2,'As senhas não conferem');
            return false;
        } 
    }
    else{
        if(conf2.val() == senha2.val()){
            removeErroCampo(senha2);
            removeErroCampo(conf2);
            setSucessCampo(conf2);
        }
        else{
            if(conf2.val() != ''){
                setFatalErrorCampo(conf2,'As senhas não conferem');
                return false;
            }
        }
    }
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