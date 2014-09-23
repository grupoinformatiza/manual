<?php
namespace Suporte;
use Exception;
class Upload{

    
    private $extensoesPermitidas;
    private $img;
    private $diretorio;
    private $nome;
    private $extensao;
            
    function __construct($dadosImg,$nome = null){
        $this->extensoesPermitidas = array('jpg','png');
        $this->img = $dadosImg;
        $this->nome = strtolower(str_replace(' ','_',$nome));
    }
    
    public function setDiretorio($dir){
        if(!is_dir($dir))
            throw new Exception("Diretório não encontrado");
        $this->diretorio = $dir;
    }
    
    private function validarExtensao(){
        $this->extensao = end(explode('.',$this->img['name']));
        if(!in_array($this->extensao, $this->extensoesPermitidas))
                throw new Exception("Extensão $this->extensao não é permitida.");
    }
    
    public function processar(){
        $this->validarExtensao();
        $novoNome = $this->diretorio.$this->nome.'.'.$this->extensao;
        
        
        if(!move_uploaded_file($this->img['tmp_name'],$novoNome))
                throw new Exception("Não foi possível mover a imagem.");
        
        return $this->nome.'.'.$this->extensao;
    }
    
    
    
}