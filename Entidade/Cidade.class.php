<?php
namespace Entidade;
use Exception;
    class Cidade extends Base {
        private $nome;
        
        private $estado;
        
        
        public function __construct($_codigo,$_nome,Estado $_estado){
            $this->Codigo = $_codigo;
            $this->Nome = $_nome;
            $this->Estado = $_estado;
        }
        
        public function __toString() {
            return $this->Nome;
        }
        
        public function setNome($_nome) {
                if ($_nome == "")
                    throw new Exception("Nome deve ser preenchido");
                $this->nome = $_nome;                        
                
        }
        
        public function getNome() {
                return $this->nome;
        }
        
        public function setEstado(Estado $_estado) {
                if ($_estado == "")
                    throw new Exception("Estado deve ser preenchido");
                $this->estado = $_estado;

        }
        
        public function getEstado() {
                return $this->estado;
        }
        
        
      
        
        
               
        
    }

