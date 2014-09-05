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
        <div class="container">
            <div class="jumbotron">
                <h1>Manual Online</h1>
                <p>Este site foi desenvolvido para conter toda a documentação referente a um projeto no colégio CTI - UNESP</p>
                <p>
                    <a class="btn btn-lg btn-success" href="pub/index/index.php">
                        Ver Tutoriais
                    </a>
                </p>
            </div>                
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
        
        <div class="footer">
           <p>Desenvolvido por: Grupo Informatiza / 2014</p> 
        </div>
    </center>      
    </body>
    
    <script type="text/javascript" src="libs/jquery-1.11.1.min.js" ></script>
    <script type="text/javascript" src="index.js"></script>
    <script type="text/javascript" src="libs/bootstrap/js/bootstrap.min.js"></script>
</html>
