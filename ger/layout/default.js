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
    })
    
    $('.alert').addClass('in');
    setTimeout(function(){
        $('.alert-success').alert('close');
    },2500);
});

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
    c.focus();
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
        .removeClass('has-error has-feedback')
        .find('span').remove();
}
