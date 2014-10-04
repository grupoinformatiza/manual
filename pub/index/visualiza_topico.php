<?php
if(isset($_GET['cod'])):
    if(!defined('ROOT_PATH'))
        define('ROOT_PATH', '../../');
    require_once "../../config.php";
    try{
        $codigo = $_GET['cod'];
        $topico = \Servico\TopicoDAO::getTopico($codigo);  
        $top_titulo = $topico->Titulo;
        $top_conteudo = $topico->Conteudo;
        $top_codigo = $codigo;
    } catch (Exception $ex) {
        $erro = $ex->getMessage();
    }
?>

    <ol class="breadcrumb">
        <li><a href="index.php">Inicio</a></li>
        <li><a href=""><?php echo $topico->Tutorial->Nome; ?></a></li>
        <li class="active"><a href=""><?php echo $topico->Titulo ?></a></li>
    </ol>

    <h1 id="tituloTopico"><?php echo $topico->Titulo ?></h1>
    <p id="conteudoTopico"><?php echo $topico->Conteudo ?></p>   
    
    
    <div class="well well-sm">
       Este tópico foi útil?
       <a class="btn btn-md btn-default">
           <span class="glyphicon glyphicon-thumbs-up"></span> Sim
       </a>
       <a class="btn btn-md btn-default">
           <span class="glyphicon glyphicon-thumbs-down"></span> Não
       </a>
    </div>
    
    <?php  if(Suporte\Autenticacao::checkLogin()) : ?>
        <a class="btn btn-default btn-md pull-right" id="btnEditar" href="../../ger/topico/edicao_topico.php?acao=editar&codigo=<?php echo $topico->Codigo; ?>" target="_blank">
            <span class="glyphicon glyphicon-edit"></span> Editar
        </a>
    <?php endif; ?>

<?php endif; ?>