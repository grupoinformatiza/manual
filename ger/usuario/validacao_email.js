function validarEmail(campo){
    if(campo.val() == ''){
        removeErroCampo(campo);
    }else{
            var email = $('#txtEmail').val();
            var usuario = email.substring(0, email.indexOf("@")); 
            var dominio = email.substring(email.indexOf("@")+ 1, email.length); 
            if (!((usuario.length >=1) && (dominio.length >=3) && (usuario.search("@")==-1) && (dominio.search("@")==-1) && (usuario.search(" ")==-1) && (dominio.search(" ")==-1) && (dominio.search(".")!=-1) && (dominio.indexOf(".") >=1)&& (dominio.lastIndexOf(".") < dominio.length - 1))) {  
                setFatalErrorCampo(campo,'E-mail incorreto');
            }else
            {
                removeErroCampo(campo);
            }
        
    }
}