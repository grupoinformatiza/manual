<?php
namespace Estatistica;
use Exception;


    class Entidade extends Base{
        private $topico;
        private $ip;
        private $data;
        private $positivo;
        private $comentario;
                     
        
        public function setTopico($_topico) {
                if ($_topico == "")
                    throw new Exception("Tópico deve ser diferente de 0");
                $this->topico = $_topico;
                
        }
        
        public function setIp($_ip){
            if ($_ip == "")
                throw new Exception("Erro ao pegar IP");
            $this->ip = $_ip;

        }
        
        public function setPositivo($_positivo){
            if ($_positivo == "")
                throw new Exception ("Positivo deve ser diferente de 0");
            $this->positivo = $_positivo;
        }
        
        public function setComentario($_comentario){
            if ($_comentario == "")
                throw new Exception ("Comentário deve ser diferente de vazio");
            $this->comentario = $_comentario;
        }
        
        public function setData($data){
            $this->data = $data;
        }
        
        public function getTopico(){
            return $this->topico;
        }        
        public function getIp(){
            return $this->ip;
        }        
        public function getPositivo(){
            return $this->positivo;
        }       
        public function getComentario(){
            return $this->cometario;
        }
        public function getData(){
            return $this->data;
        }
        public function getDataBr(){
            $dt = new \DateTime($this->data);
            return $dt->format('d/m/Y');
        }    
    }
