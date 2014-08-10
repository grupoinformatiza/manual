<?php

namespace Suporte;
use PDO;

class PdoFactory {
    
    
    public static function getConexao(){
        return new PDO("pgsql:host=127.0.0.1;dbname=manual", "postgres", "oklahoma1");
    }
    
    
}
