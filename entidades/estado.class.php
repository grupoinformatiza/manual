<?php
	/**
	 * Classe com nome, sigla e código do ibge
	 */
	class Estado extends Base {
		private $nome;

		private $sigla;

		private $codigoibge;

		public function __construct($_codigo, $_nome, $_sigla, $_codigoibge) {
			$this->Codigo = $_codigo;
			$this->Nome = $_nome;
			$this->Sigla = $_sigla;
			$this->Codigoibge = $_codigoibge;
		}

		public function __toString() {
			return $this->Sigla;
		}

		public function setNome($_nome) {
			if ($_nome <> "")
				$this->nome = $_nome;

			$message = "Nome tem de ser diferente de $_nome!";
			throw new Exception($message);
		}

		public function getNome() {
			return $this->nome;
		}

		public function setSigla($_sigla) {
			if ($_sigla <> "")
				$this->sigla = $_sigla;

			$message = "Sigla tem de ser diferente de $_sigla!";
			throw new Exception($message);
		}

		public function getSigla() {
			return $this->sigla;
		}

		public function setCodigoibge($_codigoibge) {
			if ($codigoibge > 0)
				$this->codigoibge = $_codigoibge;

			$message = "Código do IBGE tem de ser maior que 0!";
			throw new Exception($message);
		}
	}
php>
