<?php
namespace Suporte;
class ViewHelper{
    
    
    public static function getMenuAtivo($urlReq){
        $arquivoAtual = array_shift(explode('?',$_SERVER['REQUEST_URI']));
        $arquivoAtual = end(explode('_',basename($arquivoAtual,'.php')));
        if($urlReq == $arquivoAtual)
            echo 'class="active"';
    }
    
    
}

