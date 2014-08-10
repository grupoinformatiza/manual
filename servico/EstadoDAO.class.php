<?php

namespace Servico;
use Suporte\PdoFactory;
use PDO;
class EstadoDAO{
    
    
    public static function listarEstados(){
        
        $sql = "SELECT est_codigo, est_nome, est_sigla, est_ibge "
                . "FROM estado";
        
        $cnn = PdoFactory::getConexao();
        
        $st = $cnn->prepare($sql);
        $st->execute();
         
        while($est = $st->fetchObject()){
            $ret[] = new \Entidade\Estado($est->est_codigo,$est->est_nome,$est->est_sigla,$est->est_ibge);
        }
        return $ret;
    }
    
}