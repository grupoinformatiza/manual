<?php
namespace Entidade;
use Exception;

    class Tutorial extends Base{
        private $nome;
        private $tipo;
        private $imagem;
        private $ordem;
        private $usuario;
        private $data;
                     
        public function setNome($_nome){
            if ($_nome == "")
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
        
        public function getTipoDescricao(){
            if($this->Tipo == 1)
                return "Usuário";
            return "Administrador";
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
            
        public function getData(){
            return $this->data;
        }
        
        public function setData($data){
            $this->data = $data;
        }
        
        public function getUsuario(){
            return $this->usuario;
        }
        
        public function setUsuario($usuario){
            if($usuario == "")
                throw new Exception("Usuário deve ser diferente de 0");
            $this->usuario = $usuario;
        }        

    }
