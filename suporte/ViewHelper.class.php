<?php
namespace Suporte;

class ViewHelper{
    
    
    public static function getMenuAtivo($urlReq){
        $arquivoAtual = array_shift(explode('?',$_SERVER['REQUEST_URI']));
        $arquivoAtual = end(explode('_',basename($arquivoAtual,'.php')));
        if($urlReq == $arquivoAtual)
            echo 'class="active"';
    }
    
    public static function prepararPaginacao($conexao,$sql,$parametros = null){
        
        $paginacao = new \Suporte\PDO_Pagination($conexao);
        $paginacao->setLimitPerPage(2);
        $paginacao->setSQL($sql,$parametros);
        $paginacao->setPaginator('pag');
        
        return $paginacao;
    }
    
    
}

