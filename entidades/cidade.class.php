<?php

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
        
        public function setNome($_nome) {
                if ($_nome <> "")
                        $this->nome = $_nome;

                $message = "Nome tem de ser diferente de $_nome!";
                throw new Exception($message);
        }
        
        public function getNome() {
                return $this->nome;
        }
        
        public function setEstado(Estado $_estado) {
                if ($_estado <> "")
                        $this->estado = $_estado;

                $message = "Estado tem de ser diferente de $_estado!";
                throw new Exception($message);
        }
        
        public function getEstado() {
                return $this->estado;
        }
        
        public function setCodigoibge($_codigoibge) {
                if ($_codigoibge > 0){
                        $this->codigoibge = $_codigoibge;
                }

                $message = "Código do IBGE tem de ser maior que 0!";
                throw new Exception($message);
        }
       
    }

