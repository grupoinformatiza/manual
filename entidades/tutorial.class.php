<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

    class tutorial extends Base{
        private $nome;
        private $tipo;
        private $imagem;
        
        public function __construct($_codigo, $_nome, $_tipo, $_imagem) {
            $this->codigo = $_codigo;
            $this->nome = $_nome;
            $this->tipo = $_tipo;
            $this->imagem = $_imagem;
        }
        
        public function setNome($_nome){
            if ($nome <> "")
                $this->nome = $_nome;
            
            $message = "Nome deve ser diferente de $_nome!";
            throw new Exception($message);
        }
        
        public function getNome(){
            return $this->nome;
        }
        
        public function setTipo($_tipo){
            if ($_tipo <> "")
                $this->tipo = $_tipo;
            
            $message = "tipo deve ser diferente de $_tipo!";
            throw new Exception($message);
        }
        
        public function getTipo(){
            return $this->tipo;
        }
    
        public function setImagem($_imagem){
            if ($_imagem <> ""){
                $this->imagem = $_imagem;
            }
            $message = "imagem deve ser diferente de $_imagem!";
            throw new Exception($message);
        }
        
        public function getImagem(){
            return $this->imagem;
        }
        
        }

