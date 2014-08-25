<?php 
namespace Suporte;
class Autenticacao{
    
    public static function autenticar($login,$senha){
        return true;
    }
    
    public static function paginaSegura(){
        $logado = true;
        if(!$logado){
            $msg = urlencode("Somente administradores podem acessar esta página.");
            header("Location: login.php?erro=$msg");
        }
    }
    
    
}