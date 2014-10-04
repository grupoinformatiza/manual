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
        private $ordem;
        private $data;
        private $usuario;
        private $keywords;
                     
        
        public function setTitulo($_titulo) {
                if ($_titulo == "")
                    throw new Exception("Título deve ser preenchido");
                $this->titulo = $_titulo;
                
        }
        
        public function setOrdem($_ordem){
            if ($_ordem == "")
                throw new Exception("Ordem deve ser preenchida");
            $this->ordem = $_ordem;

        }
        
        public function getOrdem(){
            return $this->ordem;
        } 
        
        public function getTitulo(){
            return $this->titulo;
        }        
        
        public function getData(){
            return $this->data;
        }
        
        public function getDataBr(){
            $dt = new \DateTime($this->data);
            return $dt->format('d/m/Y');
        }
        
        public function setData($data){
            $this->data = $data;
        }
        
        public function getKeywords(){
            return $this->keywords;
        }
        
        public function setKeywords($keywords){
            $this->keywords = $keywords;
        }        
        
        public function getUsuario(){
            return $this->usuario;
        }
        
        public function setUsuario($usuario){
            if($usuario == '')
                throw new Exception("Usuário deve ser diferente de 0");
            $this->usuario = $usuario;
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
