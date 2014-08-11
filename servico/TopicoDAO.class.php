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
    
}
