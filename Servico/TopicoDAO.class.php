<?php

namespace Servico;
use PDO;
use Exception;
class TopicoDAO{
    
    
    public static function gravar(\Entidade\Topico $topico){
             
        $con = \Suporte\PdoFactory::getConexao();
        
        $sql = "INSERT INTO topico (top_titulo,top_conteudo,tut_codigo) "
                . "VALUES (:titulo,:conteudo,:tutorial) ";
        
        $st = $con->prepare($sql);
        $st->bindValue(':titulo', $topico->Titulo);
        $st->bindValue(':conteudo', $topico->Conteudo);
        $st->bindValue(':tutorial', $topico->Tutorial);
        
        $st->execute();
              
    }
    
    public static function listar($titulo, $tutorial=0){
        $titulo = strtoupper($titulo);
        $con = \Suporte\PdoFactory::getConexao();
        
        if($tutorial != 0)
            $sql = "SELECT top_codigo Codigo,top_titulo Titulo,top_conteudo Conteudo,tut_codigo Tutorial FROM topico where tut_codigo=:tutorial and top_deletado = False";
        else
            $sql = "SELECT top_codigo Codigo,top_titulo Titulo,top_conteudo Conteudo,tut_codigo Tutorial FROM topico WHERE upper(top_titulo)=:titulo and top_deletado = False";
        $st  = $con->prepare($sql);
        if($tutorial != 0)
           $st->bindValue(':tutorial', $tutorial);
        $st->bindValue(':titulo', $titulo);
        $st->execute();
        return $st->fetchAll(PDO::FETCH_CLASS,"Entidade\Topico");
    }
    
    public static function listarPaginacao($titulo=''){
        $con = \Suporte\PdoFactory::getConexao();
        $titulo = strtoupper($titulo);
        if($titulo != ''){
            $sql = "SELECT top_codigo Codigo,top_titulo Titulo,top_conteudo Conteudo,tut_codigo Tutorial FROM topico WHERE upper(top_titulo) like :titulo and top_deletado = False";
            $paginacao = \Suporte\ViewHelper::prepararPaginacao($con,$sql,array(':titulo'=>'%'.$titulo.'%'));
            $st = $con->prepare($paginacao->getSQL());
        }
        else{
            $sql = "SELECT top_codigo Codigo,top_titulo Titulo,top_conteudo Conteudo,tut_codigo Tutorial FROM topico WHERE top_deletado = False";
            $paginacao = \Suporte\ViewHelper::prepararPaginacao($con,$sql);
            $st = $con->query($paginacao->getSQL());
        }
        if($titulo != ''){
            $st->bindValue(':titulo','%'.$titulo.'%');            
        }
            
        $st->execute();
        $ret = new \stdClass();
        
        $ret->res = $st->fetchAll(PDO::FETCH_CLASS,"Entidade\Topico");
        $ret->pag = $paginacao;
        return $ret;
    }
    
    public static function getTopico($codTopico){
        
        $con = \Suporte\PdoFactory::getConexao();
        $sql = "SELECT * FROM topico WHERE top_codigo = :cod";
        $st  = $con->prepare($sql);
        $st->bindValue(':cod', $codTopico, PDO::PARAM_INT);
        $st->execute();      
        
        $u = $st->fetchObject();
        
        if(!$u)
            throw new Exception("Tópico não encontrado.");
        
        $topico = new \Entidade\Topico();
        $topico->Codigo = $u->top_codigo;
        $topico->Titulo = $u->top_titulo;
        $topico->Conteudo = $u->top_conteudo;
        $topico->Tutorial = TutorialDAO::getTutorial($u->tut_codigo);
                
        return $topico;
    }
    public static function deletarTopico($codigoTopico){
        $cod = (int)$codigoTopico;
        if($cod <= 0)
            throw new Exception("Código Inválido");
        
        $con = \Suporte\PdoFactory::getConexao();
        $sql = "UPDATE topico SET top_deletado = True WHERE top_codigo = :cod and top_deletado = FALSE";
        $st  = $con->prepare($sql);
        $st->bindValue(':cod', $cod, PDO::PARAM_INT);
        $st->execute();
        if(!$st->rowCount())
            throw new Exception("Não foi possível deletar o tópico!");
    }
    
    
}
