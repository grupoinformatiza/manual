<?php
    $textoDigitado = urldecode($_GET['pesquisa']);
    $pgControl = Servico\TopicoDAO::listarPesquisa($textoDigitado);
?>

<ol class="breadcrumb">
    <li><a href="index.php">Inicio</a></li>
    <li>Pesquisa de Tópicos</li>
    <li class="active"><a href=""><?php echo $textoDigitado ?></a></li>
</ol>

<h1>Resultados da pesquisa</h1>
<?php echo $pgControl->pag->printResultBar(); ?>

<?php foreach($pgControl->res as $topico) : ?>
<a href="index.php?cod=<?php echo $topico->Codigo ?>">
    <div class="container-topico-resultado">
        <h3><?php echo $topico->Titulo ?></h3>
        <p><?php echo substr(strip_tags($topico->Conteudo),0,200) ?>...</p>
        <p class="text-muted">
            <a class="btn btn-sm btn-default"><?php echo $topico->Tutorial->Nome ?> (<?php echo $topico->Tutorial->TipoDescricao ?>)</a>  
            Última alteração realizada por <?php echo $topico->Usuario->Nome ?> em <?php echo $topico->DataBr; ?>
        </p>
    </div>
</a>
<?php endforeach; ?>

<?php echo $pgControl->pag->printNavigationBar(); ?>
