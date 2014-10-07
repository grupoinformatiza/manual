<?php

if(isset($_GET['tutorial'])):
    $tutorial= Servico\TutorialDAO::getTutorial($_GET['tutorial']);
    $topicos = Servico\TopicoDAO::listarTop($tutorial->Codigo);


?>

    <h1><?php echo $tutorial->Nome ?></h1>
        <ol class="breadcrumb">
            <li><a href="index.php">Início</a></li>
            <li class="active"><a href=""><?php echo $tutorial->Nome ?></a></li>
        </ol>

    <?php foreach($topicos as $topico) : ?>
        <h3><?php echo $topico->Titulo ?></h3>
    <?php endforeach; ?>
        
<?php endif; ?>