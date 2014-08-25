<?php

namespace Servico;
use Suporte\PdoFactory;
use PDO;
use Exception;
class EstadoDAO{
    
    
    public static function listarEstados(){
        
        $sql = "SELECT est_codigo codigo, est_nome nome, est_sigla sigla "
                . "FROM estado";
        
        $cnn = PdoFactory::getConexao();
        
        $st = $cnn->prepare($sql);
        $st->execute();
         
        
        return $st->fetchAll(PDO::FETCH_CLASS,"Entidade\Estado");
    }
    
    public static function carregarEstado($codigoEstado){
        if(trim($codigoEstado) == '')
            throw new Exception("Código do estado não foi preenchido. Não será possível carrega-lo");
        
        $sql = "SELECT est_codigo codigo, est_nome nome, est_sigla sigla "
                . "FROM estado "
                . "WHERE est_codigo = :cod";
        
        $cnn = PdoFactory::getConexao();
        
        $st = $cnn->prepare($sql);
        $st->bindValue(':cod', $codigoEstado, PDO::PARAM_INT);
        $st->execute();
         
        $est = $st->fetchObject("Entidade\Estado");
        return $est;
        
    }
    
}