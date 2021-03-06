<?php

namespace Entidade;
use Exception;
    class Usuario extends Base {
        private $nome;
        private $dataNascimento;
        private $sexo;
        private $cidade;
        private $email;
        private $login;
        private $senha;
        private $adm;
               
        public function setCidade(Cidade $_cidade){
            if($_cidade == "")
                throw new Exception("Cidade deve ser preenchido");
            $this->cidade = $_cidade;
        }
        
        public function getCidade(){
            return $this->cidade;
        }
        
        public function setNome($_nome) {
            if ($_nome == "")
                throw new Exception("Nome deve ser preenchido");
            $this->nome = $_nome;

        }
        
        public function setAdm($_adm){
            $this->adm = $_adm;
        }
        
        public function getAdm(){
            return $this->adm;
        }
        
        public function getNome(){
            return $this->nome;
        }
        
        public function setDataNascimento($_dataNascimento){
            if ($_dataNascimento == "")
                throw new Exception("Data de nascimento deve ser preenchido");
            
            $data = \DateTime::createFromFormat('d/m/Y', $_dataNascimento);
            if(!$data)
                $data = \DateTime::createFromFormat('Y-m-d', $_dataNascimento);
            
            $this->dataNascimento = $data->format('d/m/Y');
        }  
        
        public function getDataNascimento(){
            return $this->dataNascimento;
        }
        
        public function setSexo($_sexo){
            if ($_sexo == "")
                throw new Exception("Sexo deve ser selecionado");
            
            $this->sexo = $_sexo;
        }  
        
        public function getSexo(){
            return $this->sexo;
        }
        
         public function setEmail($_email){
            if ($_email == "")
                throw new Exception("Email deve ser preenchido");
            $this->email = $_email;
            
        }  
        
        public function getEmail(){
            return $this->email;
        }
        
        public function setLogin($_login){
            if ($_login == "")
                throw new Exception("Login deve ser preenchido");
            $this->login = $_login;
          
        }  
        
        public function getLogin(){
            return $this->login;
        }
        
        public function setSenha($_senha){
            if ($_senha == "")
                throw new Exception("Senha deve ser preenchido");
            $this->senha = $_senha;
         
        }  
        
        public function getSenha(){
            return $this->senha;
        }
        
             
    }



