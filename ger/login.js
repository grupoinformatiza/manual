$(function(){
    $('#frmLogin').submit(validaLogin);
});

function validaLogin(e){
    
    if(!validarCampos('txtLogin,txtSenha'))
        e.preventDefault();  
}


