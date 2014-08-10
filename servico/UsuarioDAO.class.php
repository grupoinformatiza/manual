<?php

namespace Servico;
use PDO;
use Exception;
class UsuarioDAO{
    
    
    public static function gravar(\Entidade\Usuario $usuario){
             
        $con = \Suporte\PdoFactory::getConexao();
        
        $sql = "INSERT INTO usuario (usu_nome,usu_nasc,usu_sexo,usu_email,"
                . "cid_codigo,usu_login) "
                . "VALUES (:nome,:nasc,:sexo,:email,"
                . ":cidade,:login)";
        
        $st = $con->prepare($sql);
        $st->bindValue(':nome', $usuario->Nome);
        $st->bindValue(':nasc', $usuario->DataNascimento);
        $st->bindValue(':sexo', $usuario->Sexo);
        $st->bindValue(':email', $usuario->Email);
        $st->bindValue(':cidade', $usuario->Cidade->Codigo);
        $st->bindValue(':login', $usuario->Login);
        
        $st->execute();
       
        
    }
    
}

