<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

    class cidade extends Base {
        private $nome;
        
        private $estado;
        
        private $codigoibge;
        
        public function __construct($_codigo,$_nome,$_estado,$_codigoibge){
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
        
        public function setEstado($_estado) {
                if ($_estado <> "")
                        $this->estado = $_estado;

                $message = "Nome tem de ser diferente de $_estado!";
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

