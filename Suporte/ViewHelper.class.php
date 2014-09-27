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
    
    public static function prepararPaginacao($conexao,$sql,$parametros = null){
                
        
        $paginacao = new \Suporte\PDO_Pagination($conexao);
        $paginacao->setLimitPerPage(10);
        $paginacao->setSQL($sql,$parametros);
        $paginacao->setPaginator('pag');
        
        return $paginacao;
    }
    
    
}

