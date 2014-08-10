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
                if ($_tipo <> ""){
                        $this->tipo = $_tipo;
                }

                $message = "tipo deve ser diferente de $_tipo!";
                throw new Exception($message);
        }
        
        public function getTipo(){
            return $this->tipo;
        }
        
        public function setConteudo($_conteudo) {
                if ($_conteudo <> ""){
                        $this->conteudo = $_conteudo;
                }

                $message = "Conteudo deve ser diferente de $_conteudo!";
                throw new Exception($message);
        }
        
        public function getConteudo(){
            return $this->conteudo;
        }
        
        public function setTutorial($_tutorial) {
                if ($_tutorial <> ""){
                        $this->tutorial = $_tutorial;
                }

                $message = "Tutorial deve ser diferente de $_tutorial!";
                throw new Exception($message);
        }
        
        public function getTutorial(){
            return $this->tutorial;
        }
        
    }
