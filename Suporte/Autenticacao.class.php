<?php 
namespace Suporte;
class Autenticacao{
    
    public static function autenticar($login,$senha){
        
        $sql = "SELECT usu_codigo,usu_adm FROM usuario WHERE usu_login = :login AND usu_senha = :senha";
        $conexao = PdoFactory::getConexao();
        
        $st = $conexao->prepare($sql);
        $st->bindValue(':login', $login);
        $st->bindValue(':senha', $senha);
        $st->execute();
        
        if($st->rowCount() == 0)
            throw new Exception("Dados Inválidos.");
              
        
        
        return true;
    }
    
    public static function sair(){
        header("Location: login.php");
    }
    
    public static function paginaSegura(){
        $logado = true;
        if(!$logado){
            $msg = urlencode("Somente administradores podem acessar esta página.");
            header("Location: login.php?erro=$msg");
        }
    }
    
    
}