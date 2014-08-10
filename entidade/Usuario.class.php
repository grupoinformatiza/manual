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
        
        
        public function __construct($_codigo,$_nome,$_dataNascimento,$_cidade,$_sexo, $_email, $_login, $_senha) {
            $this->Codigo = $_codigo;
            $this->Nome = $_nome;
            $this->DataNascimento = $_dataNascimento;
            $this->Sexo = $_sexo;
            $this->Email = $_email;
            $this->Login = $_login;
            $this->Senha = $_senha;
            $this->Cidade = $_cidade;
        }
       
        public function setCidade(Cidade $_cidade){
            if($_cidade == "")
                throw new Exception("Cidade deve ser preenchido");
            $this->cidade = $_cidade;
        }
        
        public function setNome($_nome) {
                if ($_nome == "")
                    throw new Exception("Nome deve ser preenchido");
                $this->nome = $_nome;
                $message = "Nome tem que ser diferente de $_nome!";
                throw new Exception($message);
        }
        
        public function getNome(){
            return $this->nome;
        }
        
        public function setDataNascimento($_dataNascimento){
            if ($_dataNascimento == "")
                throw new Exception("Data de nascimento deve ser preenchido");
            $this->dataNascimento = $_dataNascimento;
            
            
            $message = "Data de nascimento deve ser diferente de $_dataNascimento!";
            
            throw new Exception($message);
        }  
        
        public function getDataNascimento(){
            return $this->dataNascimento;
        }
        
        public function setSexo($_sexo){
            if ($_sexo == ""){
                throw new Exception("Sexo deve ser selecionado");
            $this->sexo = $_sexo;
            }
            
            $message = "Sexo deve ser diferente de $_sexo!";
            
            throw new Exception($message);
        }  
        
        public function getSexo(){
            return $this->sexo;
        }
        
         public function setEmail($_email){
            if ($_email == "")
                throw new Exception("Email deve ser preenchido");
            $this->email = $_email;
            
            
            $message = "Email deve ser diferente de $_email!";
            
            throw new Exception($message);
        }  
        
        public function getEmail(){
            return $this->email;
        }
        
        public function setLogin($_login){
            if ($_login == "")
                throw new Exception("Nome deve ser preenchido");
            $this->login = $_login;
            
            
            $message = "Login deve ser diferente de $_login!";
            
            throw new Exception($message);
        }  
        
        public function getLogin(){
            return $this->login;
        }
        
        public function setSenha($_senha){
            if ($_senha == "")
                throw new Exception("Nome deve ser preenchido");
            $this->senha = $_senha;
            
            
            $message = "Senha deve ser diferente de $_senha!";
            
            throw new Exception($message);
        }  
        
        public function getSenha(){
            return $this->senha;
        }
        
             
    }



