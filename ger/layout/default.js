$(function(){
      
    $('.btn-deletar').click(function(e){
        e.preventDefault();           

        var link = $(this).attr('href');
        $('#confirmDelete').find('.btn-danger').attr('href',link);
        $('#confirmDelete').modal({
            keyboard:true
        });

    });
    
    $('#confirmDelete').on('shown.bs.modal', function () {
        $('#btnConfirma').focus();
    });
    
    $('#frmAlterarSenha').submit(alterarSenha);
    
    $('.alert:not(#altErro)').addClass('in');
    setTimeout(function(){
        $('.alert-success').alert('close');
    },2500);
});

function alterarSenha(e){
    e.preventDefault();
    if(validarCampos('txtAlSenhaAtual,txtAlNovaSenha,txtAlNovaSenhaConf')){
        $.post(
            $(this).attr('action'),
            $(this).serialize(),
            function(ret){
                if(ret.status){
                    $('#erroPlaceholder').html("<div class='alert alert-success' id='altErro' role='alert'>Senha alterada com sucesso!</div>");
                }else{
                    $('#erroPlaceholder').html("<div class='alert alert-danger' id='altErro' role='alert'>"+ret.msg+"</div>");
                }
            },
            'json'
        );
    }
}

function validarCampos(campos){
    
    var campo, primeiroCampo;
    var arrayCampos = campos.split(',');
    var deuCerto = true;
    for(var x in arrayCampos){
        campo = arrayCampos[x];
        var c = $('#'+campo);
        var frmGrp = c.parent('.form-group');
        if(c.val() == ''){ //pesquisar se é um select
            if (deuCerto == true)
                primeiroCampo = c;
            setErroCampo(c);
            deuCerto = false;
        }else{
            removeErroCampo(c);
        }       
    }
    primeiroCampo.focus();
    return deuCerto;
}

function setErroCampo(campo){
    campo.closest('.form-group').find('span').remove();
    campo.closest('.form-group')
        .addClass('has-error has-feedback')
        .prepend('<span class="glyphicon glyphicon-exclamation-sign form-control-feedback"></span>');
}
function removeErroCampo(campo){
    campo.closest('.form-group')
        .removeClass('has-error has-warning has-success has-feedback')
        .find('span').remove();
    campo.closest('.form-group')
        .find('p').remove()
}
function setFatalErrorCampo(campo,mensagem){
    removeErroCampo(campo);
    if(mensagem){
        campo.closest('.form-group').append('<p class="help-block">'+mensagem+'</p>');
    }
    campo.closest('.form-group')
        .addClass('has-error has-feedback')
        .prepend('<span class="glyphicon glyphicon-remove form-control-feedback"></span>');
}
function setSucessCampo(campo){
    removeErroCampo(campo);
    campo.closest('.form-group')
        .addClass('has-success has-feedback')
        .prepend('<span class="glyphicon glyphicon-ok form-control-feedback"></span>');
}
function setWarningCampo(campo,mensagem){
    removeErroCampo(campo);
    if(mensagem){
        campo.closest('.form-group').append('<p class="help-block">'+mensagem+'</p>');
    }
    campo.closest('.form-group').addClass('has-warning');
}