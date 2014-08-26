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
    
    var arrayCampos = campos.split(',');
    var deuCerto = true;
    for(var x in arrayCampos){
        var campo = arrayCampos[x];
        var c = $('#'+campo);
        if(c.val() == ''){ //pesquisar se é um select
            c.attr('placeholder','Campo obrigatório');
            c.parent('.form-group').addClass('has-error');
            deuCerto = false;
        }else{
            c.parent('.form-group').removeClass('has-error');
        }
    }
    return deuCerto;
}