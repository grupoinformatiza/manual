<!DOCTYPE HTML>
<?php 
define("ROOT_PATH","");
require "config.php";
$tipo = '1';
$tutoriais = \Servico\TutorialDAO::listarTutoriais($tipo);   
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Manual Informatiza</title>
        <link rel="stylesheet" href="libs/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="default.css" />
    </head>
    <body role="document">
    <center>
        <?php  require_once 'pub/layout/cabecalho.php'; ?>
        <div class="container">
            <h1> MANUAL ONLINE </h1>
            <h2>Sistema de compartilhamento em nuvem</h2>
            <h3>Colégio Técnico Industrial - BAURU/SP</h3>  
            <br><br><br><br>
        </div>
        
        <div class="container marketing">
            
            <div class="row">
                <?php $c=0; foreach($tutoriais as $tut) : if($c==3) break; ?>                
                <div class="col-lg-4" >
                    <a href="/pub/index/">
                        <img class="img-circle"  src="<?php echo $tut->Imagem ?>" style="width: 140px; height: 140px;"><br>    
                        <?php echo $tut->Nome?>
                    </a>
                </div>
                <?php $c++; endforeach; ?> 
            </div>
                
        </div>
        
        <br><br><br><br><br>
        <p>Desenvolvido por: Grupo Informatiza / 2014</p>
    </center>      
    </body>
    
    <script type="text/javascript" src="libs/jquery-1.11.1.min.js" ></script>
    <script type="text/javascript" src="index.js"></script>
    <script type="text/javascript" src="libs/bootstrap/js/bootstrap.min.js"></script>
</html>
