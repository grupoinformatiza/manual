<?php

class Registry {
    protected static $instancia;
    private $dados = array();

    final protected function __construct() {
    }

    public static function getInstancia() {
        if(static::$instancia === null) {
                static::$instancia = new static();
        }
        return static::$instancia;
    }

    public function set($obj) {
        if(!is_object($obj)) {
                throw new Exception('Registry armazena somente objetos, 
                                                        você forneceu ' . gettype($obj));
        }

        $classe = get_class($obj);
        if(isset($this->dados[$classe])) {
                throw new Exception('Já existe uma instância de ' 
                                                        . $classe . ' no registro');
        }

        $this->dados[$classe] = $obj;
    }

    public function get($classe) {
        if(isset($this->dados[$classe])) {
                return $this->dados[$classe];
        } else {
                throw new Exception("$classe não encontrado.");
        }
    }
}