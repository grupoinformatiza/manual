<?php

namespace Servico;
use PDO;
use Exception;
class TopicoDAO{
    
    
    public static function gravar(\Entidade\Topico $topico){
             
        $con = \Suporte\PdoFactory::getConexao();
        if($topico->Codigo != ''){
            $sql = "UPDATE topico SET top_titulo=:titulo, top_conteudo=:conteudo,tut_codigo=:tutorial, top_ordem=:ordem where "
                    . "top_codigo=:codigo";
        }
        else{
        $sql = "INSERT INTO topico (top_titulo,top_conteudo,tut_codigo,top_ordem) "
                . "VALUES (:titulo,:conteudo,:tutorial, :ordem) ";
        }
        $st = $con->prepare($sql);
        $st->bindValue(':titulo', $topico->Titulo);
        $st->bindValue(':conteudo', $topico->Conteudo);
        $st->bindValue(':tutorial', $topico->Tutorial->Codigo);
        $st->bindValue(':ordem', $topico->Ordem);
        if($topico->Codigo != ''){
            $st->bindValue(':codigo', $topico->Codigo);
        }
        
        $st->execute();
              
    }
    
    public static function listar($titulo, $tutorial=0){
        $titulo = strtoupper($titulo);
        $con = \Suporte\PdoFactory::getConexao();
        
        if($tutorial != 0)
            $sql = "SELECT top_codigo Codigo,top_titulo Titulo,top_conteudo Conteudo,tut_codigo Tutorial, top_ordem Ordem FROM topico where tut_codigo=:tutorial and top_deletado = False order by top_ordem";
        else
            $sql = "SELECT top_codigo Codigo,top_titulo Titulo,top_conteudo Conteudo,tut_codigo Tutorial, top_ordem Ordem FROM topico WHERE upper(top_titulo) like :titulo and top_deletado = False order by top_ordem";
        $st  = $con->prepare($sql);
        if($tutorial != 0)
           $st->bindValue(':tutorial', $tutorial);
        $st->bindValue(':titulo','%'.$titulo.'%'); 
        $st->execute();
        return $st->fetchAll(PDO::FETCH_CLASS,"Entidade\Topico");
    }
    
    public static function listarTop($tutorial){
        $con = \Suporte\PdoFactory::getConexao();
        $sql = "SELECT top_codigo Codigo,top_titulo Titulo,top_conteudo Conteudo,tut_codigo Tutorial, top_ordem Ordem FROM topico where tut_codigo=:tutorial and top_deletado = False order by top_ordem";
        $st  = $con->prepare($sql);
        $st->bindValue(':tutorial', $tutorial);
        $st->execute();
        return $st->fetchAll(PDO::FETCH_CLASS,"Entidade\Topico");
    }

    public static function getOrdem($tutorial){
        $con = \Suporte\PdoFactory::getConexao();
        $sql = "SELECT coalesce(max(top_ordem), 0)+1 as prox FROM topico where tut_codigo=:tutorial and top_deletado = False";
        $st  = $con->prepare($sql);
        $st->bindValue(':tutorial', $tutorial);
        $st->execute();
        
        $tut = $st->fetchObject();
        $prox = $tut->prox;
        return $prox;        
    }
    
    public static function listarPaginacao($titulo=''){
        $con = \Suporte\PdoFactory::getConexao();
        $titulo = strtoupper($titulo);
        if($titulo != ''){
            $sql = "SELECT top_codigo Codigo,top_titulo Titulo,top_conteudo Conteudo,tut_codigo Tutorial, top_ordem Ordem FROM topico WHERE upper(top_titulo) like :titulo and top_deletado = False";
            $paginacao = \Suporte\ViewHelper::prepararPaginacao($con,$sql,array(':titulo'=>'%'.$titulo.'%'));
            $st = $con->prepare($paginacao->getSQL());
        }
        else{
            $sql = "SELECT top_codigo Codigo,top_titulo Titulo,top_conteudo Conteudo,tut_codigo Tutorial, top_ordem Ordem FROM topico WHERE top_deletado = False";
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
        $topico->Ordem = $u->top_ordem;
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
    
    public static function ajustarOrdemTopico($topicos){
        if(!is_array($topicos))
            throw new Exception("Parâmetro inválido para troca de ordens");
        
        $conexao = \Suporte\PdoFactory::getConexao();
        
        $sql = "UPDATE topico SET top_ordem = :ordem WHERE top_codigo = :codigo";
        $st  = $conexao->prepare($sql);
        try{
            $conexao->beginTransaction();
            
            foreach($topicos as $ordem => $codigo){
                $st->bindValue(':ordem', $ordem+1);
                $st->bindValue(':codigo', $codigo);
                $st->execute();
            }
            
            $conexao->commit();
        }catch(Exception $ex){
            $conexao->rollBack();
            throw new Exception($ex->getMessage());
        }
    }
    
    
}
