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
    
        <div class="container marketing">
            <div class="jumbotron">
                <img src="imagens/capa.png" class="img-responsive pull-left"/>
                <h1>Manual Online</h1>
                <p>Este site foi desenvolvido para conter toda a documentação referente a um projeto no colégio CTI - UNESP</p>
                <p>
                    <a class="btn btn-lg btn-primary" href="pub/index/index.php">
                        Ver tutoriais
                    </a>
                </p>
            </div>                
            
        
            
            <div class="row">
                <?php $c=0; foreach($tutoriais as $tut) : if($c==3) break; ?>                
                <div class="col-lg-4 text-center tutorial" >
                    <a href="/pub/index/">
                        <img class="img-circle"  src="<?php echo $tut->Imagem ?>" style="width: 140px; height: 140px;"><br>    
                        <a href="pub/index/index.php?acao=listartutorial&cod=<?php echo $tut->Codigo; ?>">
                            <h3><?php echo $tut->Nome?></h3></a>
                    </a>
                </div>
                <?php $c++; endforeach; ?> 
            </div>
                
        </div>            
        
        <div class="footer">
            <div class="container">
                <p class="text-muted">Desenvolvido por: Grupo Informatiza / 2014 </p>
            </div>
        </div>
    
    </body>
    
    <script type="text/javascript" src="libs/jquery-1.11.1.min.js" ></script>
    <script type="text/javascript" src="index.js"></script>
    <script type="text/javascript" src="libs/bootstrap/js/bootstrap.min.js"></script>
</html>
