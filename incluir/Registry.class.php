<?php
namespace incluir;
/* Design pattern Registry
 * Legal para armazenar variaveis globais com segurança no trabalho em equipe.
 */

class Registry {
    //Definindo os atributos da classe
    protected static $instancia;
    private $dados = array();

    /**
     * Construtor
     * Este é protected porque estamos implementando o design pattern Singleton
     * Onde só uma instancia da classe existirá.
     */
    final protected function __construct() {
    }

    /**
     * getInstancia()
     * Retorna a instancia da classe.
     * Feito desta maneira porque estamos utilizando o padrão Singleton,
     * porque queremos apenas uma instancia desta classe no nosso projeto inteiro.
     * @return Registry
     */
    public static function getInstancia() {
        if(static::$instancia === null) {
                static::$instancia = new static(); //instanciando a propria classe.
        }
        return static::$instancia;
    }

    /**
     * set()
     * Este método é utilizado para adicionar objetos ao registro.
     * @param type $nome - nome para armazenamento no array interno
     * @param type $obj  - o objeto que nome dará acesso.
     * @throws Exception
     */
    public function set($nome,$obj) {
        if(!is_object($obj)) {
                throw new Exception('Registry armazena somente objetos, 
                                                        você forneceu ' . gettype($obj));
        }

        if(isset($this->dados[$nome])) {
                throw new Exception('Já existe uma objeto nomeado de ' . $nome . ' no registro');
        }

        $this->dados[$nome] = $obj;
    }

    /**
     * get()
     * Método para recuperar objetos guardados no registry
     * @param type $nome - indice para acessar o objeto no array
     * @return Object - retorna a instancia de um objeto armazenado
     * @throws Exception
     */
    public function get($nome) {
        if(isset($this->dados[$nome])) {
                return $this->dados[$nome];
        } else {
                throw new Exception("$nome não encontrado.");
        }
    }
}