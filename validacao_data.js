function validarData( campo ) {
        var data = campo.val();
        var dataatual = new Date();
        var anomax = dataatual.getFullYear();
        
        data = data.replace(/[^0-9\/]/g, "");
        
        var partes = data.split("/");
 
        if( partes.length != 3 ){ 
            setFatalErrorCampo(campo,'Data inválida (dd/mm/aaaa)');
            return false;
        }
 
        var dia = partes[0];
        var mes = partes[1];
        var ano = partes[2];
        
        if( dia.length > 2 || mes.length > 2 || ano.length > 4 ){
            setFatalErrorCampo(campo,'Data inválida (dd/mm/aaaa)');
            return false;
        } 
        if( isNaN(dia) || isNaN(mes) || isNaN(ano) ){ 
            setFatalErrorCampo(campo,'Data inválida (dd/mm/aaaa)');
            return false;
        }
        if( mes > 12 || mes < 1 || ano < 1000 || ano > anomax || dia < 1){
            setFatalErrorCampo(campo,'Data inválida (dd/mm/aaaa)');
            return false;
        }
 
        if( mes == 2 ) {
 
                maiorDia = ( ( (!(ano % 4)) && (ano % 100) ) || (!(ano % 400)) )? 29: 28;
 
                if( dia > maiorDia ){
                    setFatalErrorCampo(campo,'Data inválida (dd/mm/aaaa)');
                    return false;
                }
 
        }else {
 
                if( mes == 4 || mes == 6 || mes == 9 || mes == 11 ) {
 
                        if( dia > 30 ){
                            setFatalErrorCampo(campo,'Data inválida (dd/mm/aaaa)');
                            return false;
                        }
                }else {
 
                        if( dia > 31 ) {
                            setFatalErrorCampo(campo,'Data inválida (dd/mm/aaaa)');
                            return false;
                        }
                }
        }
        
        if(dia in [1, 2, 3, 4, 5, 6, 7, 8, 9]){
            dia = '0' + dia;
            campo.val(dia + '/' + mes + '/' + ano);
            data= campo.val();
        }
        if(mes in [1, 2, 3, 4, 5, 6, 7, 8, 9]){
            mes = '0' + mes;   
            campo.val(dia + '/' + mes + '/' + ano);
            data= campo.val();
        }
        
        
        setSucessCampo(campo);
        campo.val(data);
}