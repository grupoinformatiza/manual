<?php
	class Tutorial extends Base {
		private $nome;

		private $tipo;

		private $imagem;

		public function __construct($_nome, $_tipo, $_imagem) {
			$this->Nome = $_nome;
			$this->Tipo = $_tipo;
			$this->Imagem = $_imagem;
		}

		public function setNome($_nome) {
			if ($_nome <> "")
				$this->nome = $_nome;

			$mensagem = "Nome tem de ser diferente de $_nome!";
			throw new Exception($mensagem);
		}

		public function getNome() {
			return $this->nome;
		}

		public function setTipo($_tipo) {
			if ($_tipo <> "")
				$this->tipo = $_tipo;

			$mensagem = "Tipo tem de ser diferente de $_tipo!";
			throw new Exception($mensagem);
		}

		public function getTipo() {
			return $this->tipo;
		}

		public function setImagem($_imagem) {
			if ($_imagem <> "")
				$this->imagem = $_imagem;

			$mensagem = "Imagem tem de ser diferente de $_imagem!";
			throw new Exception($mensagem);
		}

		public function getImagem() {
			return $this->imagem;
		}
	}
