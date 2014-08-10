<?php

namespace Servico;
use PDO;
use Exception;
class TutorialDAO{
    
    
    public static function gravar(\Entidades\Tutorial $tutorial){
             
        $con = \Suporte\PdoFactory::getConexao();
        
        $sql = "INSERT INTO tutorial (tut_nome,tut_tipo,tut_imagem) "
                . "VALUES (:nome,:tipo,:imagem) ";
        
        $st = $con->prepare($sql);
        $st->bindValue(':nome', $tutorial->Nome);
        $st->bindValue(':tipo', $tutorial->Tipo);
        $st->bindValue(':imagem', $tutorial->Imagem);

        
        $st->execute();
       
        
    }
    
}

