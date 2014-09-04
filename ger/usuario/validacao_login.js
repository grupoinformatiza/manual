function validarLogin(campo,nivel){
    if(campo.val() == ''){
        setWarningCampo(campo,'Informe o Login');
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