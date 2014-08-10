<?php
namespace Entidade;
use Exception;
    /**
     * Classe com métodos __get e __set para facilitar o acesso de propriedades 
     * e com código pois todas as entidades terão este campo
     */
    class Base {
        private $codigo;

        public function __get($name) {
                $getter = 'get'.$name;

                if (method_exists($this, $getter)){
                        return $this->$getter();
                }
                $message = sprintf('Class "%1$s" does not have a property named "%2$s" or a method named "%3$s".', get_class($this), $name, $getter);

                throw new \OutOfRangeException($message);
        }

        public function __set($name, $value) {
                $setter = 'set'.$name;

                if (method_exists($this, $setter)){
                        return $this->$setter($value);
                }
                $getter = 'get'.$name;

                if (method_exists($this, $getter)){
                        $message = sprintf('Implicit property "%2$s" of class "%1$s" cannot be set because it is read-only.', get_class($this), $name);
                }
                else{
                    $message = sprintf('Class "%1$s" does not have a property named "%2$s" or a method named "%3$s".', get_class($this), $name, $setter);
                }
                throw new \OutOfRangeException($message);
        }

        public function getCodigo() {
                return $this->codigo;
        }

        public function setCodigo($_codigo) {
                if ($_codigo <= 0)
                    throw new Exception("Codigo tem que ser maior que 0");
                
                $this->codigo = $_codigo;
                
        }

    }
