<?php
namespace Servico;
use PDO;
use Exception;
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
        if(trim($codigoCidade) == '')
            throw new Exception("Código da cidade não foi preenchido. Não será possível carrega-la");
        
        $sql = "SELECT * "
                . "FROM cidade "
                . "WHERE cid_codigo = :cod";
        
        $cnn = \Suporte\PdoFactory::getConexao();
        
        $st = $cnn->prepare($sql);
        $st->bindValue(':cod', $codigoCidade, PDO::PARAM_INT);
        $st->execute();
         
        $cid = $st->fetchObject();
        
        $estado = EstadoDAO::carregarEstado($cid->est_codigo);
        
        $cidade = new \Entidade\Cidade($cid->cid_codigo,$cid->cid_nome,$estado,$cid->cid_ibge);
        
        return $cidade;
    }
    
    public static function getComboCidade($codigoEstado,$cidadeSelecionada = ''){
        $cidades = CidadeDAO::listarCidades($codigoEstado);
        //Montando o combo de cidades
        $opt = "";
        foreach($cidades as $cid){
            $opt .= "<option value='$cid->Codigo' ".(($cid->Codigo == $cidadeSelecionada)?"selected='selected'":"").">$cid</option>";
        }
        return $opt;
    }
    
}

