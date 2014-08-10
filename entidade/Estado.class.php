<?php
namespace Entidade;
use Exception;
    /**
     * Classe com nome, sigla e código do ibge
     */
    class Estado extends Base {
        private $nome;
        private $sigla;
        private $codigoibge;

  

        public function __toString() {
                return $this->Sigla . ' - ' . $this->Nome;
        }

        public function setNome($_nome) {
                if ($_nome == "")
                    throw new Exception("Nome deve ser preenchido");
                $this->nome = $_nome;
        }

        public function getNome() {
                return $this->nome;
        }

        public function setSigla($_sigla) {
                if ($_sigla == "")
                    throw new Exception("Sigla deve ser preenchida");
                $this->sigla = $_sigla;
        }

        public function getSigla() {
                return $this->sigla;
        }

        public function setCodigoibge($_codigoibge) {
                if ($_codigoibge > 0){
                        $this->codigoibge = $_codigoibge;
                }else{

                    $message = "Código do IBGE deve ser maior que 0!";
                    throw new Exception($message);
                }
        }
        
        public function getCodigoibge(){
            return $this->codigoibge;
        }
    }
