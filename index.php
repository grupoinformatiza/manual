<?php 
require "config.php";
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Manual Informatiza</title>
        <link rel="stylesheet" href="libs/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="default.css" />
    </head>
    <body role="document">
        <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container">
              <div class="navbar-header">
                <a class="navbar-brand" href="#">Informatiza</a>
              </div>
            </div>
        </div>
        <div class="container-fluid" role="main">
            <div class="row">
                <div class="col-sm-3 col-md-2 sidebar">
                    <ul class="nav nav-sidebar">
                        <li class="active"><a href="">ownCloud</a></li>
                        <li><a href="">SAMBA4</a></li>
                        <li><a href="">Linux</a></li>
                    </ul>                    
                </div>
                
                <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                
                    <div id="teste" class="alert alert-success"></div>
                    <div id="teste2" class="alert alert-info"></div>
                    <div class="jumbotron">
                        <h1>Exemplo Twitter Bootstrap</h1>
                        <p>Mostrando classes básicas do twitter bootstrap em conjunto com o exemplo anterior</p>
                        <input type="button" class="btn btn-primary btn-lg" id="botao" value="Clique aqui" />

                    </div>
                </div>
            </div>
        </div>
    </body>
    <script type="text/javascript" src="libs/jquery-1.11.1.min.js" ></script>
    <script type="text/javascript" src="index.js"></script>
    <script type="text/javascript" src="libs/bootstrap/js/bootstrap.min.js"></script>
</html>
