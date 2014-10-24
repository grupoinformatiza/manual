<?php

namespace Servico;
use PDO;
use Exception;
class EstatisticaDAO{
    
    public static function gravar(\Entidade\Estatistica $estatistica){  
        $con = \Suporte\PdoFactory::getConexao();  
        
        $estatistica->Ip = $_SERVER['REMOTE_ADDR'];
        $estatistica->Data = date('Y-m-d H:i:s');
        
        $sql = "INSERT INTO estatistica (top_codigo,esc_ip,esc_cadastro,esc_positivo,esc_comentario) "
                . "VALUES(:topico,:ip,:data,:positivo,:comentario)";
        
        
        $st = $con->prepare($sql);
        $st->bindValue(':topico', $estatistica->Topico->Codigo);
        $st->bindValue(':ip', $estatistica->Ip);
        $st->bindValue(':data', $estatistica->Data);
        $st->bindValue(':positivo', $estatistica->Positivo);
        $st->bindValue(':comentario', $estatistica->Comentario);
        
        $st->execute();        
    }
    
    public static function listaTop10Avalia()
    {
        $con = \Suporte\PdoFactory::getConexao();
        $sql = "select top_titulo, (select count(*) from estatistica where esc_positivo=TRUE and top_codigo=EST.top_codigo) as POSITIVO,"
            ."(select count(*) from estatistica where esc_positivo=FALSE and top_codigo=EST.top_codigo) as NEGATIVO "
            ."from estatistica as EST " 
            ."inner join topico TOP on (EST.top_codigo=TOP.top_codigo)"
            ."group by EST.top_codigo, top_titulo";
        $st = $con->prepare($sql);
        
        $st->execute();
        
        $avaliacoes = array();
        $ava = new \stdClass();
        
        $ava->Topico = null;
        $ava->Like = null;
        $ava->Dislike = null;
        
        
        while($rs = $st->fetchObject()){
            $ava->Topico = $rs->top_titulo;
            $ava->Like = $rs->positivo;
            $ava->Dislike = $rs->negativo;
            $avaliacoes[] = $ava;
        }
        return $avaliacoes;
    }
    
    
    public static function listarTopicos($pesquisa='',$tutorial=0)
    {
        $con = \Suporte\PdoFactory::getConexao();
        
        /* select tut_nome,top_titulo, (select count(*) from estatistica where esc_positivo=TRUE and top_codigo=EST.top_codigo) as POSITIVO,
            (select count(*) from estatistica where esc_positivo=FALSE and top_codigo=EST.top_codigo) as NEGATIVO
            from estatistica as EST 
            inner join topico TOP on (EST.top_codigo=TOP.top_codigo)
            inner join tutorial TUT on(TOP.tut_codigo=TUT.tut_codigo)
            where TUT_nome='TESTE7' and TOP_TITULO=''
            group by EST.top_codigo, top_titulo, tut_nome*/ 
        
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