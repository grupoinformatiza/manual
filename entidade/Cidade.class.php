<?php
namespace Entidade;
use Exception;
    class Cidade extends Base {
        private $nome;
        
        private $estado;
        
        private $codigoibge;
        
        public function __construct($_codigo,$_nome,Estado $_estado,$_codigoibge){
            $this->Codigo = $_codigo;
            $this->Nome = $_nome;
            $this->Estado = $_estado;
            $this->codigoibge = $_codigoibge;
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
        
        
        public function setCodigoibge($_codigoibge) {
                if ($_codigoibge == "")
                    throw new Exception("Código do IBGE deve ser preenchido");
                if ($_codigoibge <= 0)
                    throw new Exception("Código do IBGE deve ser maior que 0!");
                $this->codigoibge = $_codigoibge;
                
        }
        
        public function getCodigoibge(){
            return $this->codigoibge;
        }
        
        
               
        
    }

