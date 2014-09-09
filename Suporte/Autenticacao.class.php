<?php 
namespace Suporte;
use Exception;
class Autenticacao{
    
    public static function autenticar($login,$senha){
        
        if(trim($login) == '')
            throw new Exception("Preencha o login");
        
        if(trim($senha) == '')
            throw new Exception("Preencha a senha");
        
        $sql = "SELECT usu_codigo,usu_adm FROM usuario WHERE usu_login = :login AND usu_senha = :senha AND usu_deletado = False";
        $conexao = PdoFactory::getConexao();
        $st = $conexao->prepare($sql);
        $st->bindValue(':login', strtoupper($login));
        $st->bindValue(':senha', md5($senha));
        $st->execute();
        
        if($st->rowCount() == 0)
            throw new Exception("Dados Inválidos.");
        
        $rs = $st->fetchObject();
        
        $usuario = \Servico\UsuarioDAO::getUsuario($rs->usu_codigo);
                
        if(!$usuario->Adm)
            throw new Exception("Usuário não tem privilégios de administrador");
        
        $_SESSION['web']['usuario'] = $usuario;
        header("Location: index.php");
        
        return true;
    }
    
    public static function sair(){
        session_destroy();
    }
    
    public static function checkLogin(){
        $logado = false;
        if(isset($_SESSION['web']['usuario']))
            $logado = true;
        return $logado;
    }
    
    public static function paginaSegura(){
        if(!self::checkLogin()){
            header("Location: ".ROOT_PATH."ger/login.php");
        }
    }
    
    
}
