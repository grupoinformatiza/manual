<?php
namespace Entidade;
use Exception;
    /**
     * Classe com nome, sigla e código do ibge
     */
    class Estado extends Base {
        private $nome;
        private $sigla;


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

        
    }
