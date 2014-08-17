<?php

namespace Servico;
use PDO;
use Exception;
class TutorialDAO{
    
    
    public static function gravar(\Entidade\Tutorial $tutorial){
        
        $imagem = self::enviarImagem($tutorial);
        
        $con = \Suporte\PdoFactory::getConexao();
        
        $sql = "INSERT INTO tutorial (tut_nome,tut_tipo,tut_imagem) "
                . "VALUES (:nome,:tipo,:imagem) ";
        
        $st = $con->prepare($sql);
        $st->bindValue(':nome', $tutorial->Nome);
        $st->bindValue(':tipo', $tutorial->Tipo);
        $st->bindvalue(':imagem',$imagem);
        
        $st->execute();
        
        
    }
    
    public static function enviarImagem(\Entidade\Tutorial $tutorial){
        
        if(!is_null($tutorial->Imagem)){
            
            $upl = new \Suporte\Upload($tutorial->imagem,$tutorial->Nome.' '.$tutorial->Tipo);
            $upl->setDiretorio(ROOT_PATH.'imagens/capa_tutoriais/');
            
            $nome = $upl->processar();
            return $nome;
        }
        
    }
    
    public static function listar(){
        $con = \Suporte\PdoFactory::getConexao();
        $sql = "SELECT tut_codigo Codigo,tut_nome Nome,tut_tipo Tipo FROM tutorial";
        $st  = $con->prepare($sql);
        $st->execute();
        return $st->fetchAll(PDO::FETCH_CLASS,"Entidade\Tutorial");
    }
    
    public static function getTutorial($codTutorial){
        
        $con = \Suporte\PdoFactory::getConexao();
        $sql = "SELECT * FROM tutorial WHERE tut_codigo = :cod";
        $st  = $con->prepare($sql);
        $st->bindValue(':cod', $codTutorial, PDO::PARAM_INT);
        $st->execute();      
        
        $u = $st->fetchObject();
        
        if(!$u)
            throw new Exception("Tutorial não encontrado.");
        
        $tutorial = new \Entidade\Tutorial();
        $tutorial->Codigo = $u->tut_codigo;
        $tutorial->Nome = $u->tut_nome;
        $tutorial->Tipo = $u->tut_tipo;
                
        return $tutorial;
    }
     public static function deletarTutorial($codigoUsuario){
        $cod = (int)$codigoTutorial;
        if($cod <= 0)
            throw new Exception("Código Inválido");
        
        $con = \Suporte\PdoFactory::getConexao();
        $sql = "UPDATE tutorial SET tut_deletado = True WHERE tut_codigo = :cod";
        $st  = $con->prepare($sql);
        $st->bindValue(':cod', $cod, PDO::PARAM_INT);
        $st->execute();
        if(!$st)
            throw new Exception("Não foi possível deletar o tutorial!");
    }
    
}