<?php
namespace Servico;
use PDO;
use Exception;
error_reporting(E_ALL);
ini_set("display_errors", 1);
class UsuarioDAO{
    
    
    public static function gravar(\Entidade\Usuario $usuario){
             
        $con = \Suporte\PdoFactory::getConexao();
        
        if($usuario->Codigo != ''){
            $sql = "UPDATE usuario "
                    . "SET usu_nome = :nome,"
                    . "usu_nasc = :nasc,"
                    . "usu_sexo = :sexo,"
                    . "usu_email = :email,"
                    . "cid_codigo = :cidade,"
                    . "usu_login = :login,"
                    . "usu_senha = :senha "
                    . "WHERE usu_codigo = :codigo";
        }else{
            $sql = "INSERT INTO usuario (usu_nome,usu_nasc,usu_sexo,usu_email,"
                    . "cid_codigo,usu_login,usu_senha) "
                    . "VALUES (:nome,:nasc,:sexo,:email,"
                    . ":cidade,:login,:senha)";
        }
        $st = $con->prepare($sql);
        if($usuario->Codigo != '')
            $st->bindValue (':codigo', $usuario->Codigo);
        $st->bindValue(':nome', $usuario->Nome);
        $st->bindValue(':nasc', $usuario->DataNascimento);
        $st->bindValue(':sexo', $usuario->Sexo);
        $st->bindValue(':email', $usuario->Email);
        $st->bindValue(':cidade', $usuario->Cidade->Codigo);
        $st->bindValue(':login', $usuario->Login);
        $st->bindValue(':senha', md5(time()));
        
        $st->execute();    
    }
    
    public static function listar(){
        $con = \Suporte\PdoFactory::getConexao();
        $sql = "SELECT usu_codigo Codigo,usu_nome Nome,usu_email Email FROM usuario";
        $st  = $con->prepare($sql);
        $st->execute();
        return $st->fetchAll(PDO::FETCH_CLASS,"Entidade\Usuario");
    }
    
    public static function getUsuario($codUsuario){
        
        $con = \Suporte\PdoFactory::getConexao();
        $sql = "SELECT * FROM usuario WHERE usu_codigo = :cod";
        $st  = $con->prepare($sql);
        $st->bindValue(':cod', $codUsuario, PDO::PARAM_INT);
        $st->execute();      
        
        $u = $st->fetchObject();
        
        if(!$u)
            throw new Exception("Usuário não encontrado.");
        
        $usuario = new \Entidade\Usuario();
        $usuario->Codigo = $u->usu_codigo;
        $usuario->Nome = $u->usu_nome;
        $usuario->Email = $u->usu_email;
        $usuario->Sexo = $u->usu_sexo;
        $usuario->Login = $u->usu_login;
        $usuario->DataNascimento = $u->usu_nasc;
        $usuario->Cidade = CidadeDAO::carregarCidade($u->cid_codigo);
        
        return $usuario;
    }
    
}

