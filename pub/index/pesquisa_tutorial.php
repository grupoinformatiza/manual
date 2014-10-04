<?php

$codigo = $_GET['codigo'];
$tutorial= Servico\TutorialDAO::getTutorial($codigo);
$topicos = Servico\TopicoDAO::listarTop($tutorial);

?>

<h1><?php echo $tutorial->Nome ?></h1>
    <ol class="breadcrumb">
        <li><a href="index.php">Início</a></li>
        <li class="active"><a href=""><?php echo $tutorial->Nome ?></a></li>
    </ol>

<?php foreach($topicos as $topico) : ?>
    <h3><?php echo $topico->Titulo ?></h3>
<?php endforeach; ?>
