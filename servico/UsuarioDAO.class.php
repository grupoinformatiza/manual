<?php

namespace Servico;
use PDO;
use Exception;
class UsuarioDAO{
    
    
    public static function gravar(\Entidade\Usuario $usuario){
             
        $con = \Suporte\PdoFactory::getConexao();
        
        $sql = "INSERT INTO usuario (usu_nome,usu_nasc,usu_sexo,usu_email,"
                . "cid_codigo,usu_login,usu_senha) "
                . "VALUES (:nome,:nasc,:sexo,:email,"
                . ":cidade,:login,:senha)";
        
        $st = $con->prepare($sql);
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
        return $st->fetchAll(PDO::FETCH_CLASS,"\Entidade\Usuario");
        
    }
    
}

