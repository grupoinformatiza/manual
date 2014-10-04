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
        <link rel="stylesheet" href="index.css" />
    </head>
    <body role="document">
        <div class="jumbotron">
                <h1>Manual Online</h1>
                <p>Este site foi desenvolvido para conter toda a documentação referente a um projeto no colégio CTI - UNESP</p>
                <p>
                    <a class="btn btn-lg btn-primary" href="pub/index/index.php">
                        Ver tutoriais
                    </a>
                </p>
        </div>  
        <div class="container marketing">
                          
            
        
            
            <div class="row">
                <?php $c=0; foreach($tutoriais as $tut) : if($c==3) break; ?>    
                
                <div class="col-sm-6 col-md-4 col-xs-6">
                    <div class="thumbnail">
                        <img  src="<?php echo $tut->Imagem ?>" alt="...">
                        <div class="caption">
                            <h3 class="text-center"><?php echo $tut->Nome?></h3>
                        </div>
                    </div>
                </div>
                
                <!--<div class="col-lg-4 text-center tutorial" >
                    <a href="/pub/index/">
                        <img class="img-circle"   style="width: 140px; height: 140px;"><br>    
                        <a href="pub/index/index.php?acao=listartutorial&cod=<?php echo $tut->Codigo; ?>">
                            <h3><?php echo $tut->Nome?></h3></a>
                    </a>
                </div>-->
                <?php $c++; endforeach; ?> 
            </div>
                
        </div>            
        
        <div class="footer">
            <div class="container-fluid">
                <p class="text-muted text-center">
                    Desenvolvido por: Grupo Informatiza / 2014 
                    <?php if(!Suporte\Autenticacao::checkLogin()): ?>
                        <a class="text-info pull-right" href="ger/login.php"><span class="glyphicon glyphicon-log-in"></span> Entrar</a>
                    <?php endif; if(Suporte\Autenticacao::checkLogin()): ?>
                        <a class="text-info pull-right" href="ger/index.php"><span class="glyphicon glyphicon-lock"></span> Administração</a>
                    <?php endif; ?>
                </p>
            </div>
        </div>
    
    </body>
    
    <script type="text/javascript" src="libs/jquery-1.11.1.min.js" ></script>
    <script type="text/javascript" src="index.js"></script>
    <script type="text/javascript" src="libs/bootstrap/js/bootstrap.min.js"></script>
</html>
