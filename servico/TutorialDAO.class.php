<?php

namespace Servico;
use PDO;
use Exception;
class TutorialDAO{
    
    
    public static function gravar(\Entidade\Tutorial $tutorial){
             
        $con = \Suporte\PdoFactory::getConexao();
        
        $sql = "INSERT INTO tutorial (tut_nome,tut_tipo,tut_imagem) "
                . "VALUES (:nome,:tipo,:imagem) ";
        
        $st = $con->prepare($sql);
        $st->bindValue(':nome', $tutorial->Nome);
        $st->bindValue(':tipo', $tutorial->Tipo);
        $st->bindValue(':imagem', $tutorial->Imagem);

        
        $st->execute();
       
        
    }
     public static function listar(){
        $con = \Suporte\PdoFactory::getConexao();
        $sql = "SELECT tut_codigo Codigo,tut_nome Nome,tut_tipo Tipo FROM tutorial";
        $st  = $con->prepare($sql);
        $st->execute();
        return $st->fetchAll(PDO::FETCH_CLASS,"Entidade\Tutorial");
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
                
        return $tutorial;
    }
    
}
