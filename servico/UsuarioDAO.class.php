<?php

namespace Servico;

class UsuarioDAO{
    
    
    public static function gravar(\Entidades\Usuario $usuario){
             
        $con = \suporte\PdoFactory::getConexao();
        
        $sql = "INSERT INTO usuario (usu_nome,usu_nasc,usu_sexo,usu_email,"
                . "cid_codigo,usu_login)"
                . "VALUES (:nome,:nasc,:sexo,:email,"
                . ":cidade,:login)";
        //$usuario->
       
        
    }
    
}

