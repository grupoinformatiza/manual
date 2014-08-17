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
    
        public static function listar(){
        $con = \Suporte\PdoFactory::getConexao();
        $sql = "SELECT top_codigo Codigo,top_titulo Titulo,top_conteudo Conteudo,tut_codigo Tutorial FROM topico";
        $st  = $con->prepare($sql);
        $st->execute();
        return $st->fetchAll(PDO::FETCH_CLASS,"Entidade\Topico");
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
        $topico->Tituo = $u->top_titulo;
        $topico->Conteudo = $u->top_conteudo;
        $topico->Tutorial = $u->tut_codigo;
                
        return $topico;
    }
     public static function deletarTopico($codigoTopico){
        $cod = (int)$codigoTopico;
        if($cod <= 0)
            throw new Exception("Código Inválido");
        
        $con = \Suporte\PdoFactory::getConexao();
        $sql = "UPDATE topico SET top_deletado = True WHERE top_codigo = :cod";
        $st  = $con->prepare($sql);
        $st->bindValue(':cod', $cod, PDO::PARAM_INT);
        $st->execute();
        if(!$st)
            throw new Exception("Não foi possível deletar o tópico!");
    }
    
}
