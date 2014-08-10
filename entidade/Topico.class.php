<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Entidade;
use Exception;
    class Topico extends Base{
        private $tipo;
        private $conteudo;
        private $tutorial;
        
        private function __construct($_codigo, $_tipo, $_conteudo, $_tutorial) {
            $this->Codigo = $_codigo;
            $this->Tipo = $_tipo;
            $this->Conteudo = $_conteudo;
            $this->Tutorial = $_tutorial;
        }
        
        
        public function setTipo($_tipo) {
                if ($_tipo == "")
                    throw new Exception("Tipo deve ser preenchido");
                $this->tipo = $_tipo;
                
        }
        
        public function getTipo(){
            return $this->tipo;
        }
        
        public function setConteudo($_conteudo) {
                if ($_conteudo == "")
                    throw new Exception("Conteúdo deve ser preenchido");
                $this->conteudo = $_conteudo;
                

        }
        
        public function getConteudo(){
            return $this->conteudo;
        }
        
        public function setTutorial($_tutorial) {
                if ($_tutorial == "")
                    throw new Exception("Tutorial deve ser preenchido");
                $this->tutorial = $_tutorial;
                
        }
        
        public function getTutorial(){
            return $this->tutorial;
        }
        
    }
