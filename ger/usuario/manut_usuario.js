$(function(){
    $('#cmbEstado').change(carregarCidades);
    $('#frmManutUsuario').submit(validaUsuario);
});
//supondo que campos = txtNome,txtDtNasc
//function validarCampos(campos){
//    
//    var arrayCampos = campos.split(',');
//    var deuCerto = true;
//    for(var x in arrayCampos){
//        var campo = arrayCampos[x];
//        var c = $('#'+campo);
//        if(c.val() != ''){
//            c.attr('placeholder','Preencha o campo...');
//            c.parent('.form-group').addClass('has-error');
//            deuCerto = false;
//        }else{
//            c.parent('.form-group').removeClass('has-error');
//        }
//    }
//    return deuCerto;
//}

function validaUsuario(e){
    
    if(!validarCampos('txtNome,txtDtNasc'))
        e.preventDefault();
    
//    if($('#txtNome').val() == ''){
//        $('#txtNome').attr('placeholder','Preencha o nome...');
//        $('#txtNome').parent('.form-group').addClass('has-error');
//        e.preventDefault();
//    }else{
//        $('#txtNome').parent('.form-group').removeClass('has-error');
//    }
//    
//    if($('#txtDtNasc').val() == ''){
//        $('#txtDtNasc').attr('placeholder', 'Preencha a data de nascimento...');
//        $('#txtDtNasc').parent('.form-group').addClass('has-error');
//        e.preventDefault();
//    }else{
//        $('#txtDtNasc').parent('.form-group').removeClass('has-error');
//    }
    
    
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