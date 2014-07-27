<?php

namespace suporte;
use PDO;

class PdoFactory {
    
    
    public static function getConexao(){
        return new PDO("pgsql:host=200.145.153.172;dbname=manual", "web", "#ok10000109*");
    }
    
    
}
