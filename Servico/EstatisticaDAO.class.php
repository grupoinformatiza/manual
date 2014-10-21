<?php

namespace Servico;
use PDO;
use Exception;
class EstatisticaDAO{
    
    public static function gravar(\Entidade\Estatistica $estatistica){  
        $con = \Suporte\PdoFactory::getConexao();  
        
        $estatistica->Ip = $_SERVER['REMOTE_ADDR'];
        $estatistica->Data = date('Y-m-d H:i:s');
        
        $sql = "INSERT INTO estatistica (top_codigo,esc_ip,esc_cadastro,esc_positivo,esc_comentario) "
                . "VALUES(:topico,:ip,:data,:positivo,:comentario)";
        
        
        $st = $con->prepare($sql);
        $st->bindValue(':topico', $estatistica->Topico->Codigo);
        $st->bindValue(':ip', $estatistica->Ip);
        $st->bindValue(':data', $estatistica->Data);
        $st->bindValue(':positivo', $estatistica->Positivo);
        $st->bindValue(':comentario', $estatistica->Comentario);
        
        $st->execute();        
    }
    
    public static function listaTop10Avalia()
    {
        $con = \Suporte\PdoFactory::getConexao();
        $sql = "select top_codigo, (select count(*) from estatistica where esc_positivo=TRUE and top_codigo=EST.top_codigo) as POSITIVO,"
            ."(select count(*) from estatistica where esc_positivo=FALSE and top_codigo=EST.top_codigo) as NEGATIVO"
            ."from estatistica as EST group by top_codigo";
        $st = $con->prepare($sql);
        
        $st->execute();
        
        $avaliacoes = array();
        
        //while($rs = $st->fetchObject()){
            //$avaliacoes
        //}
        
        return $st->fetchObject();
    }
    
}