<?php
namespace Servico;
use PDO;
use Exception;
class UsuarioDAO{
    
    
    public static function gravar(\Entidade\Usuario $usuario){
             
        $con = \Suporte\PdoFactory::getConexao();
        
        
        if($usuario->Codigo != ''){
            self::validaLogin($usuario->Usuario, $usuario->Codigo);
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
            self::validaLogin($usuario->Usuario);
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
        $sql = "SELECT usu_codigo Codigo,usu_nome Nome,usu_email Email FROM usuario WHERE usu_deletado = False";
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
    

    public static function validaLogin($login, $cod_usuario=0){
        
        $con = \Suporte\PdoFactory::getConexao();
        
        /* Verificação se o campo login está sendo alterado durante 
                uma edição */
        
        if($cod_usuario != 0)
            $sql = "SELECT USU_CODIGO FROM USUARIO WHERE LOGIN = :login and USU_CODIGO <> :cod_usuario";
        else       
            $sql = "SELECT USU_CODIGO FROM USUARIO WHERE LOGIN = :login";
        $st = $con->prepare($sql);
        $st->bindValue(':login', $login);
        if($cod_usuario != 0)
            $st->bindValue(':cod_usuario', cod_usuario);
        
        $st->execute();
        
        $u = $st->fetchObject();
        
        if($u)
            throw new Exception("Usuário indisponível.");
        
        return true;
    }

    public static function deletarUsuario($codigoUsuario){
        $cod = (int)$codigoUsuario;
        if($cod <= 0)
            throw new Exception("Código Inválido");
        
        $con = \Suporte\PdoFactory::getConexao();
        $sql = "UPDATE usuario SET usu_deletado = True WHERE usu_codigo = :cod";
        $st  = $con->prepare($sql);
        $st->bindValue(':cod', $cod, PDO::PARAM_INT);
        $st->execute();
        if(!$st)
            throw new Exception("Não foi possível deletar o usuário!");

    }
    
}

