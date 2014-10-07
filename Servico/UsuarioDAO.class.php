<?php
namespace Servico;
use PDO;
use Exception;

class UsuarioDAO{
   
    public static function gravar(\Entidade\Usuario $usuario){
             
        $con = \Suporte\PdoFactory::getConexao();
        
        
        if($usuario->Codigo != ''){
            self::validaLogin($usuario->Login, $usuario->Codigo);
            $sql = "UPDATE usuario "
                    . "SET usu_nome = :nome,"
                    . "usu_nasc = :nasc,"
                    . "usu_sexo = :sexo,"
                    . "cid_codigo = :cidade "
                    . "WHERE usu_codigo = :codigo";
        }else{
            self::validaLogin($usuario->Login);
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
        
        $st->bindValue(':cidade', $usuario->Cidade->Codigo);
        if($usuario->Codigo == ''){
            $st->bindValue(':email', $usuario->Email);
            $st->bindValue(':login', strtoupper($usuario->Login));
            $st->bindValue(':senha', md5($usuario->Senha));
        }
        
        $st->execute();    
    }
    
   
    public static function alterarSenha($senhaAtual,$novaSenha){
        if(trim($senhaAtual) == '')
            throw new Exception("Preencha a senha atual");
        if(trim($novaSenha) == '')
            throw new Exception("Preencha a nova senha");
        
        $usuario = $_SESSION['web']['usuario'];
        //Buscando a senha atual do usuário.
        $sqlSenhaAtual = "SELECT usu_senha FROM usuario WHERE usu_codigo = :codigo";
        $con = \Suporte\PdoFactory::getConexao();
        $st = $con->prepare($sqlSenhaAtual);
        
        $st->bindValue(':codigo', $usuario->Codigo);
        
        $st->execute();
        
        $res = $st->fetchObject();
        
        $senhaAtual = md5($senhaAtual);
        $novaSenha = md5($novaSenha);
        if($senhaAtual != $res->usu_senha)
            throw new Exception("Senha atual não confere");
        
        $sqlAlterar = "UPDATE usuario SET usu_senha = :senha WHERE usu_codigo = :codigo";
        $stAlt = $con->prepare($sqlAlterar);
        $stAlt->bindValue(':senha', $novaSenha);
        $stAlt->bindValue(':codigo', $usuario->Codigo);
        if(!$stAlt->execute())
            throw new Exception("Erro alterando a senha");
        
                
    }
    
    public static function listarPorNome($nome){
        $nome = strtoupper($nome);
        if(is_null($nome))
            throw new Exception("Preencha corretamente o nome");
        $con = \Suporte\PdoFactory::getConexao();
        $sql = "SELECT usu_codigo Codigo,usu_nome Nome,usu_email Email,usu_adm Adm FROM usuario WHERE usu_deletado = False AND upper(usu_nome) LIKE :nome";
        
        
        
        
        $paginacao = \Suporte\ViewHelper::prepararPaginacao($con,$sql,array(':nome'=>'%'.$nome.'%'));
       
        $st = $con->prepare($paginacao->getSQL());
        $st->bindValue(':nome','%'.$nome.'%');
        $st->execute();
        
        $ret = new \stdClass();
        
        $ret->res = $st->fetchAll(PDO::FETCH_CLASS,"Entidade\Usuario");
        $ret->pag = $paginacao;
        return $ret;
    }
    
    public static function listar(){
        $con = \Suporte\PdoFactory::getConexao();
        $sql = "SELECT usu_codigo Codigo,usu_nome Nome,usu_email Email,usu_adm Adm FROM usuario WHERE usu_deletado = False";
        
        $paginacao = \Suporte\ViewHelper::prepararPaginacao($con,$sql);
        
        $st = $con->query($paginacao->getSQL());
        
        $ret = new \stdClass();
        
        $ret->res = $st->fetchAll(PDO::FETCH_CLASS,"Entidade\Usuario");
        $ret->pag = $paginacao;
        return $ret;
        
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
        $usuario->Adm = $u->usu_adm;
        
        return $usuario;
    }
    

    public static function validaLogin($login, $cod_usuario=0){
        $login = strtoupper($login);
        $con = \Suporte\PdoFactory::getConexao();
        
        /* Verificação se o campo login está sendo alterado durante 
                uma edição */
        
        if($cod_usuario != 0)
            $sql = "SELECT USU_CODIGO FROM USUARIO WHERE upper(usu_login) = :login and usu_deletado = false and USU_CODIGO <> :cod_usuario";
        else       
            $sql = "SELECT USU_CODIGO FROM USUARIO WHERE upper(usu_login) = :login and usu_deletado = false";
        $st = $con->prepare($sql);
        $st->bindValue(':login', $login);
        if($cod_usuario != 0)
            $st->bindValue(':cod_usuario', $cod_usuario);
        
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
        $sql = "UPDATE usuario SET usu_deletado = True WHERE usu_codigo = :cod AND usu_deletado = False";
        $st  = $con->prepare($sql);
        $st->bindValue(':cod', $cod, PDO::PARAM_INT);
        $st->execute();
        if(!$st->rowCount())
            throw new Exception("Usuário não encontrado. Não foi possível deletar.");

    }
    
    public static function trocaAdm($usuario){
        $cod = $usuario->Codigo;
        if($cod <= 0)
            throw new Exception("Código Inválido");
        
        if($usuario->Adm) //se o usuario ja é adm
            $sql = "UPDATE usuario SET usu_adm = False WHERE usu_codigo = :cod AND usu_deletado = False";  
        else {//se o usuario não é adm 
            $sql = "UPDATE usuario SET usu_adm = True WHERE usu_codigo = :cod AND usu_deletado = False";
            
            self::emailConfirmarAdm($usuario);
        }
        
        $con = \Suporte\PdoFactory::getConexao();        
        $st  = $con->prepare($sql);
        $st->bindValue(':cod', $cod, PDO::PARAM_INT);
        $st->execute();
        if(!$st->rowCount())
            throw new Exception("Usuário não encontrado. Não foi possível torna-lo administrador.");
    }
        
    public static function emailCodigoUsuarioConfirmarAdm($codigoUsuario) {
        self::emailConfirmarAdm(getUsuario($codigoUsuario));
    }
    
    public static function emailConfirmarAdm(\Entidade\Usuario $usuario) {
        $t = \Suporte\Email::enviaEmail('Informatiza', 
                'informatiza03@gmail.com', 
                'grupo_03', 
                $usuario->Email, 
                utf8_decode($usuario->Nome),
                utf8_decode('Confirmação de usuário Adm'), 
                utf8_decode('Parabéns, você tornou-se em um administrador do manual on-line do grupo Informatiza do CTI'));
        
        if(!$t)
            throw new Exception("Erro enviando email!");
    }
}