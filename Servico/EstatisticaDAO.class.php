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
    
    public static function listaTop10Mais()
    {
        //tá adicionando sempre o mesmo registro, o ultimo
        
        $con = \Suporte\PdoFactory::getConexao();
        $sql = "select EST.top_codigo, top_titulo, (select count(*) from estatistica where esc_positivo=TRUE and top_codigo=EST.top_codigo) as POSITIVO,"
            ."(select count(*) from estatistica where esc_positivo=FALSE and top_codigo=EST.top_codigo) as NEGATIVO "
            ."from estatistica as EST " 
            ."inner join topico TOP on (EST.top_codigo=TOP.top_codigo)"
            ."group by EST.top_codigo, top_titulo order by positivo desc  LIMIT 10";
        $st = $con->prepare($sql);
        $st->execute();
        
        $avaliacoes = array();
        
       
        
        while($rs = $st->fetchObject()){
            $ava = new \stdClass();
            $ava->Topico = $rs->top_titulo;
            $ava->Like = $rs->positivo;
            $ava->Dislike = $rs->negativo;
            $ava->CodigoTop = $rs->top_codigo;
            $avaliacoes[] = $ava;
        }
        return $avaliacoes;
    }
    
    public static function listaTop10Menos()
    {
        //tá adicionando sempre o mesmo registro, o ultimo
        
        $con = \Suporte\PdoFactory::getConexao();
        $sql = "select EST.top_codigo, top_titulo, (select count(*) from estatistica where esc_positivo=TRUE and top_codigo=EST.top_codigo) as POSITIVO,"
            ."(select count(*) from estatistica where esc_positivo=FALSE and top_codigo=EST.top_codigo) as NEGATIVO "
            ."from estatistica as EST "
            ."inner join topico TOP on (EST.top_codigo=TOP.top_codigo) "
            ."where (select count(*) from estatistica where esc_positivo=FALSE and top_codigo=EST.top_codigo) > 0 "
            ."group by EST.top_codigo, top_titulo order by negativo desc LIMIT 10";
        $st = $con->prepare($sql);
        
        $st->execute();
        $avaliacoes = array();


              
        while($rs = $st->fetchObject()){
            $ava = new \stdClass();
            $ava->Topico = $rs->top_titulo;
            $ava->Like = $rs->positivo;
            $ava->Dislike = $rs->negativo;
            $ava->CodigoTop = $rs->top_codigo;
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
            where TUT_nome like '%T% and TOP_TITULO like '%t%'
            group by EST.top_codigo, top_titulo, tut_nome*/ 
        
        //select base
        $sql = "SELECT EST.top_codigo, tut_nome,top_titulo,pos.tot as POSITIVO,neg.tot as NEGATIVO
FROM estatistica as EST 
left join (select count(*) as tot,top_codigo from estatistica where esc_positivo = TRUE group by top_codigo) As pos ON (est.top_codigo = pos.top_codigo)
left join (select count(*) as tot,top_codigo from estatistica where esc_positivo = FALSE group by top_codigo) As neg ON (est.top_codigo = pos.top_codigo)
inner join topico TOP on (EST.top_codigo=TOP.top_codigo) 
inner join tutorial TUT on(TOP.tut_codigo=TUT.tut_codigo) ";
                //."where TUT_nome like '%T% and TOP_TITULO like '%t%' "
                //."group by EST.top_codigo, top_titulo, tut_nome ";
        
        //tratando valores
        $pesquisa = trim(strtoupper($pesquisa));
        $tutorial = (int)$tutorial;
        
        //filtro padrão
        $sql .= " WHERE top_deletado = FALSE ";
        
        $parametros = null;
        
        if($pesquisa != ''){
            $sql .= " AND upper(TOP_TITULO) like :pesquisa";
            //$sql .= " AND top_conteudo_vetor @@ to_tsquery(:pesquisa) ";
            //$pesquisa = str_replace(' ', '|', $pesquisa);
            $parametros[':pesquisa'] = '%'.$pesquisa.'%';
        }
        if($tutorial != 0){
            $sql .= " AND upper(TUT_nome) like :tutorial";
            //$sql .= " AND tut_codigo = :tutorial";
            $parametros[':tutorial'] = '%'.$tutorial.'%';
        }
        
        $sql .= " group by EST.top_codigo, top_titulo, tut_nome, pos.tot, neg.tot ";
        $parametros['count'] = 'EST.top_codigo';
        //Preparação da paginação
        $paginacao = \Suporte\ViewHelper::prepararPaginacao($con, $sql,$parametros);
        $st = $con->prepare($paginacao->getSQL());
        
        if($pesquisa != '')
            $st->bindValue (':pesquisa', '%'.$pesquisa.'%');
        
        if($tutorial != 0)
            $st->bindValue (':tutorial', '%'.$tutorial.'%');
        $st->execute();       
        $avaliacoes = array();
        
             
        while($rs = $st->fetchObject()){
            $ava = new \stdClass();
            $ava->Tutorial = $rs->tut_nome;
            $ava->Topico = $rs->top_titulo;
            $ava->Like = $rs->positivo;
            $ava->Dislike = $rs->negativo;
            $ava->CodigoTop = $rs->top_codigo;
            $avaliacoes[] = $ava;
        }
             
        $ret = new \stdClass();        
        $ret->res = $avaliacoes;
        $ret->pag = $paginacao;
        return $ret;        
    }
    
    public static function listaComentarios($topico){
        if($topico == '')
            throw new Exception("Tópico não encontrado.");
        
        $con = \Suporte\PdoFactory::getConexao();
        $sql = "select esc_comentario from estatistica where top_codigo = :topico and esc_comentario != '' order by esc_comentario";
        
        $st = $con->prepare($sql);
        $st->bindValue(':topico', $topico, PDO::PARAM_INT);
        $st->execute();
        
        $comentarios = array();
        
        while($rs = $st->fetchObject()){
            $coment = new \stdClass();
            $coment->Coments = $rs->esc_comentario;
            $comentarios[] = $coment;
        }
        return $comentarios;
        
        
    }
}