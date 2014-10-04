<?php
namespace Suporte;

class ViewHelper{
    
    
    public static function getMenuAtivo($urlReq){
        $qs = $_SERVER['REQUEST_URI'];
        $arquivoAtual = array_shift(explode('?',$qs));
        $arquivoAtual = end(explode('_',basename($arquivoAtual,'.php')));
        if($urlReq == $arquivoAtual)
            echo 'class="active"';
    }
    
    public static function removerAcento($str){
        $com_acentos=array(
        "á","Á","ã","Ã",
        "â","Â","à","À",
        "é","É","ê","Ê",
        "í","Í","ó","Ó",
        "õ","Õ","ô","Ô",
        "ú","Ú","ü","Ü",
        "ç","Ç");
        $sem_acentos=array(
                "a","A","a","A",
                "a","A","a","A",
                "e","E","e","E",
                "i","I","o","O",
                "o","O","o","O",
                "u","U","u","U",
                "c","C");

        $output_string = str_replace($com_acentos,$sem_acentos,$str);
        return $output_string;
    }
    public static function prepararPaginacao($conexao,$sql,$parametros = null){
                
        
        $paginacao = new \Suporte\PDO_Pagination($conexao);
        $paginacao->setLimitPerPage(10);
        $paginacao->setSQL($sql,$parametros);
        $paginacao->setPaginator('pag');
        
        return $paginacao;
    }
    
    
}

