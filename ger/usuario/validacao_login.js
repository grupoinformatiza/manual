function validarLogin(campo,nivel){
    if(campo.val() == ''){
        removeErroCampo(campo);
    }else{
        
        //verificando se o login é valido
        $.post(
            nivel+'manut_usuario.php',
            {acao: 'validarLogin',
             login: campo.val()
            },
            function(ret){
                if(ret.loginExiste)
                {
                    setFatalErrorCampo(campo,'Este login já está em uso.');
                }else{
                    setSucessCampo(campo);
                }
            },
            'json'
        );
        
    }
}