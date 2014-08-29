<?php

namespace Servico;
use PDO;
use Exception;
class TutorialDAO{
    
    
    public static function gravar(\Entidade\Tutorial $tutorial){
        $imagem = self::enviarImagem($tutorial);
        
        $con = \Suporte\PdoFactory::getConexao();
        
        if($tutorial->Codigo != ''){
            $sql = "UPDATE tutorial "
                    . "SET tut_nome = :nome,"
                    . "tut_tipo = :tipo,"
                    . "tut_imagem = :imagem "
                    . "WHERE tut_codigo = :codigo";
        }else{
            $sql = "INSERT INTO tutorial (tut_nome,tut_tipo,tut_imagem) "
                . "VALUES (:nome,:tipo,:imagem) ";
        }
        
        
        $st = $con->prepare($sql);
        
        if($tutorial->Codigo != '')
            $st->bindValue(':codigo', $tutorial->Codigo);
        $st->bindValue(':nome', $tutorial->Nome);
        $st->bindValue(':tipo', $tutorial->Tipo);
        $st->bindvalue(':imagem',$imagem);
        
        $st->execute();
        
        
    }
    
    public static function enviarImagem(\Entidade\Tutorial $tutorial){
        
        if(!is_null($tutorial->Imagem) && is_array($tutorial->Imagem)){
            
            $upl = new \Suporte\Upload($tutorial->Imagem,$tutorial->Nome.' '.$tutorial->Tipo);
            $upl->setDiretorio(ROOT_PATH.'imagens/capa_tutoriais/');
            
            $nome = $upl->processar();
            return $nome;
        }else{
            return $tutorial->Imagem;
        }
        
    }
    
     public static function listarPorNome($nome){
        $nome = strtoupper($nome); 
        if(is_null($nome))
            throw new Exception("Preencha corretamente o nome");
        $con = \Suporte\PdoFactory::getConexao();
        $sql = "SELECT tut_codigo Codigo,tut_nome Nome,tut_imagem Imagem FROM tutorial WHERE tut_deletado = False AND upper(tut_nome) LIKE :nome";
                              
        $paginacao = \Suporte\ViewHelper::prepararPaginacao($con,$sql,array(':nome'=>'%'.$nome.'%'));
       
        $st = $con->prepare($paginacao->getSQL());
        $st->bindValue(':nome','%'.$nome.'%');
        $st->execute();
        
        $ret = new \stdClass();
        
        $ret->res = $st->fetchAll(PDO::FETCH_CLASS,"Entidade\Tutorial");
        $ret->pag = $paginacao;
        return $ret;
    }
    
    public static function listar(){
        $con = \Suporte\PdoFactory::getConexao();
        $sql = "SELECT tut_codigo Codigo,tut_nome Nome,tut_tipo Tipo FROM tutorial WHERE tut_deletado = False";
        
        $paginacao = \Suporte\ViewHelper::prepararPaginacao($con,$sql);
        
        $st  = $con->query($paginacao->getSQL());
        $ret = new \stdClass();
        
        $ret->res = $st->fetchAll(PDO::FETCH_CLASS,"Entidade\Tutorial");
        $ret->pag = $paginacao;
        
        return $ret;
 
    }
    
    public static function getTutorial($codTutorial){
        
        $con = \Suporte\PdoFactory::getConexao();
        $sql = "SELECT * FROM tutorial WHERE tut_codigo = :cod";
        $st  = $con->prepare($sql);
        $st->bindValue(':cod', $codTutorial, PDO::PARAM_INT);
        $st->execute();      
        
        $u = $st->fetchObject();
        
        if(!$u)
            throw new Exception("Tutorial não encontrado.");
        
        $tutorial = new \Entidade\Tutorial();
        $tutorial->Codigo = $u->tut_codigo;
        $tutorial->Nome = $u->tut_nome;
        $tutorial->Tipo = $u->tut_tipo;
        $tutorial->Imagem = $u->tut_imagem; 
        
        return $tutorial;
    }
     public static function deletarTutorial($codigoTutorial){
        $cod = (int)$codigoTutorial;
        if($cod <= 0)
            throw new Exception("Código Inválido");
        
        $con = \Suporte\PdoFactory::getConexao();
        $sql = "UPDATE tutorial SET tut_deletado = True WHERE tut_codigo = :cod";
        $st  = $con->prepare($sql);
        $st->bindValue(':cod', $cod, PDO::PARAM_INT);
        $st->execute();
        if(!$st)
            throw new Exception("Não foi possível deletar o tutorial!");
    }
    
        
    public static function listarTutoriais($tipo=0){
        
        if($tipo!='')
            $sql = "SELECT tut_codigo Codigo,tut_nome Nome,tut_tipo Tipo, tut_imagem Imagem "
            . "FROM tutorial where tut_deletado = FALSE and tut_tipo=:tipo";        
        else
            $sql = "SELECT tut_codigo Codigo,tut_nome Nome,tut_tipo Tipo, tut_imagem Imagem "
            . "FROM tutorial where tut_deletado = FALSE";
        
        $cnn = \Suporte\PdoFactory::getConexao();
        $st = $cnn->prepare($sql);
        if($tipo!='')
            $st->bindValue(':tipo', $tipo);
        
        $st->execute();

        return $st->fetchAll(PDO::FETCH_CLASS,"Entidade\Tutorial");
    }     
    
}
