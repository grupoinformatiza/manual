<?php

namespace Servico;
use PDO;
use Exception;
class TopicoDAO{
    
    
    public static function gravar(\Entidade\Topico $topico){  
        $con = \Suporte\PdoFactory::getConexao();
        
        $keywords = $topico->Titulo . '||' . $topico->Conteudo;
        
        $topico->Data = date('Y-m-d H:i:s');
        $topico->Usuario = $_SESSION['web']['usuario'];
        
        if($topico->Codigo != ''){
            $sql = "UPDATE topico SET top_titulo=:titulo, top_conteudo=:conteudo,tut_codigo=:tutorial, "
                    . "top_ordem=:ordem, top_cadastro=:data, usu_codigo=:usuario, top_conteudo_vetor=to_tsvector(:keywords) where "
                    . "top_codigo=:codigo";
        }
        else{
        $sql = "INSERT INTO topico (top_titulo,top_conteudo,tut_codigo,top_cadastro,usu_codigo,top_conteudo_vetor, top_ordem) "
                . "VALUES (:titulo,:conteudo,:tutorial, :data,:usuario,to_tsvector(:keywords),:ordem) ";
        }
        $st = $con->prepare($sql);
        $st->bindValue(':titulo', $topico->Titulo);
        $st->bindValue(':conteudo', $topico->Conteudo);
        $st->bindValue(':tutorial', $topico->Tutorial->Codigo);
        $st->bindValue(':ordem', $topico->Ordem);
        $st->bindValue(':data', $topico->Data);
        $st->bindValue(':usuario', $topico->Usuario->Codigo);
        $st->bindValue(':keywords', $keywords);
        if($topico->Codigo != ''){
            $st->bindValue(':codigo', $topico->Codigo);
        }
        
        $st->execute();
              
    }
   
    public static function listarTop($tutorial){
        $con = \Suporte\PdoFactory::getConexao();
        $sql = "SELECT top_codigo Codigo,top_titulo Titulo,top_conteudo Conteudo,tut_codigo Tutorial, top_ordem Ordem FROM topico where tut_codigo=:tutorial and top_deletado = False order by top_ordem";
        $st  = $con->prepare($sql);
        $st->bindValue(':tutorial', $tutorial);
        $st->execute();
        return $st->fetchAll(PDO::FETCH_CLASS,"Entidade\Topico");
    }
      
    public static function getOrdem($tutorial){
        $con = \Suporte\PdoFactory::getConexao();
        $sql = "SELECT coalesce(max(top_ordem), 0)+1 as prox FROM topico where tut_codigo=:tutorial and top_deletado = False";
        $st  = $con->prepare($sql);
        $st->bindValue(':tutorial', $tutorial);
        $st->execute();
        
        $tut = $st->fetchObject();
        $prox = $tut->prox;
        return $prox;        
    }
    
    public static function getTopico($codTopico){
        
        $con = \Suporte\PdoFactory::getConexao();
        $sql = "SELECT * FROM topico WHERE top_codigo = :cod";
        $st  = $con->prepare($sql);
        $st->bindValue(':cod', $codTopico, PDO::PARAM_INT);
        $st->execute();      
        
        $u = $st->fetchObject();
        
        if(!$u)
            throw new Exception("Tópico não encontrado.");
        
        $topico = new \Entidade\Topico();
        $topico->Codigo = $u->top_codigo;
        $topico->Titulo = $u->top_titulo;
        $topico->Conteudo = $u->top_conteudo;
        $topico->Ordem = $u->top_ordem;
        $topico->Tutorial = TutorialDAO::getTutorial($u->tut_codigo);
                
        return $topico;
    }
    public static function deletarTopico($codigoTopico){
        $cod = (int)$codigoTopico;
        if($cod <= 0)
            throw new Exception("Código Inválido");
        
        $con = \Suporte\PdoFactory::getConexao();
        $sql = "UPDATE topico SET top_deletado = True WHERE top_codigo = :cod and top_deletado = FALSE";
        $st  = $con->prepare($sql);
        $st->bindValue(':cod', $cod, PDO::PARAM_INT);
        $st->execute();
        if(!$st->rowCount())
            throw new Exception("Não foi possível deletar o tópico!");
    }
    
    public static function deletarTopicoTutorial($codigoTutorial){
        $cod = (int)$codigoTutorial;
        if($cod <= 0)
            throw new Exception("Código Inválido");
        
        $con = \Suporte\PdoFactory::getConexao();
        $sql = "UPDATE topico SET top_deletado = True WHERE tut_codigo = :cod and top_deletado = FALSE";
        $st  = $con->prepare($sql);
        $st->bindValue(':cod', $cod, PDO::PARAM_INT);
        $st->execute();
        if(!$st)
            throw new Exception("Não foi possível deletar o tópico!");
    }
    
    public static function ajustarOrdemTopico($topicos){
        if(!is_array($topicos))
            throw new Exception("Parâmetro inválido para troca de ordens");
        
        $conexao = \Suporte\PdoFactory::getConexao();
        
        $sql = "UPDATE topico SET top_ordem = :ordem WHERE top_codigo = :codigo";
        $st  = $conexao->prepare($sql);
        try{
            $conexao->beginTransaction();
            
            foreach($topicos as $ordem => $codigo){
                $st->bindValue(':ordem', $ordem+1);
                $st->bindValue(':codigo', $codigo);
                $st->execute();
            }
            
            $conexao->commit();
        }catch(Exception $ex){
            $conexao->rollBack();
            throw new Exception($ex->getMessage());
        }
    }
    
    public static function listarPesquisa($pesquisa='',$tutorial=0){
        $con = \Suporte\PdoFactory::getConexao();
        
        
        //select base
        $sql = "SELECT top_codigo,top_titulo, top_conteudo, usu_codigo, top_cadastro, tut_codigo "
                . "FROM topico ";
        
        //tratando valores
        $pesquisa = trim(strtoupper($pesquisa));
        $tutorial = (int)$tutorial;
        
        //filtro padrão
        $sql .= " WHERE top_deletado = FALSE ";
        
        $parametros = null;
        
        if($pesquisa != ''){
            $sql .= " AND top_conteudo_vetor @@ to_tsquery(:pesquisa) ";
            $pesquisa = str_replace(' ', '|', $pesquisa);
            $parametros[':pesquisa'] = '%'.$pesquisa.'%';
        }
        if($tutorial != 0){
            $sql .= " AND tut_codigo = :tutorial";
            $parametros[':tutorial'] = $tutorial;
        }
        
        //Preparação da paginação
        $paginacao = \Suporte\ViewHelper::prepararPaginacao($con, $sql,$parametros);
        $st = $con->prepare($paginacao->getSQL());
        
        if($pesquisa != '')
            $st->bindValue (':pesquisa', '%'.$pesquisa.'%');
        
        if($tutorial != 0)
            $st->bindValue (':tutorial', $tutorial);
        
        $st->execute();
        
        $topicos = array();
        
        while($rs = $st->fetchObject()){
            $topico = new \Entidade\Topico();
            $topico->Codigo = $rs->top_codigo;
            $topico->Titulo = $rs->top_titulo;
            $topico->Conteudo = $rs->top_conteudo;
            $topico->Usuario = UsuarioDAO::getUsuario($rs->usu_codigo);
            $topico->Tutorial = TutorialDAO::getTutorial($rs->tut_codigo);
            $topico->Data = $rs->top_cadastro;
            $topicos[] = $topico;
        }
        
        
        
        
        $ret = new \stdClass();        
        $ret->res = $topicos;
        $ret->pag = $paginacao;
        return $ret;
    }
}
