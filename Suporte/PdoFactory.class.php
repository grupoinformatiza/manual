<?php

namespace Suporte;
use PDO;

class PdoFactory {
    
    
    public static function getConexao(){
        $cn = new PDO("pgsql:host=127.0.0.1;dbname=manual", "postgres", "sqladmin");
        $cn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $cn; 
    }
    
    
}

