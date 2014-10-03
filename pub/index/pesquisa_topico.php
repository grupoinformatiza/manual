<?php

    $textoDigitado = $_GET['pesquisa'];
   
    $pgControl = Servico\TopicoDAO::listarPesquisa($textoDigitado);

?>


<h1>Resultados da pesquisa</h1>
<ol class="breadcrumb">
    <li><a href="index.php">Início</a></li>
    <li class="active"><a href=""><?php echo $textoDigitado ?></a></li>
</ol>

<?php foreach($pgControl->res as $topico) : ?>
    <h3><?php echo $topico->Titulo ?></h3>
    <p><?php echo strip_tags(substr($topico->Conteudo,0,100)) ?></p>
<?php endforeach; ?>
