<?php
namespace Servico;
use PDO;
use \Exception;
class CidadeDAO{
    
    
    public static function listarCidades($codigoEstado){
        
        if(trim($codigoEstado) == '')
            throw new Exception ("Estado não foi preenchido corretamente");
        
        $cn = \Suporte\PdoFactory::getConexao();
        
        $sql = "SELECT cid_codigo, cid_nome,cid_ibge "
                . "FROM cidade "
                . "WHERE est_codigo = :estado";
        $st  = $cn->prepare($sql);
        $st->bindValue(':estado', $codigoEstado, PDO::PARAM_INT);  
        $st->execute();
        
        $objEstado = EstadoDAO::carregarEstado($codigoEstado);
        
        $ret = array();
        
        while($cid = $st->fetchObject()){
            $ret[] = new \Entidade\Cidade($cid->cid_codigo,$cid->cid_nome,$objEstado,$cid->cid_ibge);
        }
        
        return $ret;
    }
    
    public static function carregarCidade($codigoCidade){
                
    }
    
}

