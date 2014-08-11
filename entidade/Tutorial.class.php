<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Entidade;
use Exception;

    class Tutorial extends Base{
        private $nome;
        private $tipo;
        private $imagem;
                     
        public function setNome($_nome){
            if ($nome == "")
                throw new Exception("Nome deve ser preenchido");
            $this->nome = $_nome;

        }
        
        public function getNome(){
            return $this->nome;
        }
        
        public function setTipo($_tipo){
            if ($_tipo == "")
                throw new Exception("Tipo deve ser preenchido");    
            $this->tipo = $_tipo;
  
        }
        
        public function getTipo(){
            return $this->tipo;
        }
    
        public function setImagem($_imagem){
            if ($_imagem == "")
                throw new Exception("Imagem deve ser preenchido");
            $this->imagem = $_imagem;

        }
        
        public function getImagem(){
            return $this->imagem;
        }
        
        }


