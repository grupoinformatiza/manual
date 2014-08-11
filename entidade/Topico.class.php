<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Entidade;
use Exception;
    class Topico extends Base{
        private $titulo;
        private $conteudo;
        private $tutorial;
                     
        
        public function setTitulo($_tipo) {
                if ($_tipo == "")
                    throw new Exception("Título deve ser preenchido");
                $this->titulo = $_titulo;
                
        }
        
        public function getTitulo(){
            return $this->titulo;
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
