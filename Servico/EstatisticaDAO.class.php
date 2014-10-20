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
        //Tenho o ID do tópico mas quero o titulo e o id do tutorial
        //Mas como retornar depois sendo que terei $topicos e $avaliacao?
    }
    
}