<!DOCTYPE HTML>
<?php 
require "config.php";
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
        <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Abrir Menu</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <button type="button" class="btn btn-primary btn-xs pull-left visible-xs" data-toggle="menulateral">
                        Índice
                    </button>
                    <a class="navbar-brand" href="#">
                        <img src="imagens/informatiza_pequeno.png"/> Informatiza
                    </a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#">Sobre</a></li>
                        <li><a href="#">Desenvolvedor</a></li>
                        <li class="active"><a href="#">Usuário</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container-fluid" role="main">
            <div class="row">
                <div class="col-md-2 col-sm-2 col-xs-12 sidebar menulateral">
                    <ul class="nav  nav-sidebar">
                        <li class="nav-header">ownCloud<div class="pull-right">&#9650;</div></li>
                        <li class="active"><a href="index.php?topico=Introducao">Introdução</a></li>
                        <li><a href="index.php?topico=Criando">Criando conta</a></li>
                        <li><a href="index.php?topico=Enviando">Enviando arquivos</a></li>
                        <li class="nav-header">SAMBA4<div class="pull-right">&#9660;</div></li>
                        <li class="nav-header">Linux<div class="pull-right">&#9660;</div></li>
                    </ul>                    
                </div>
                
                <div class="col-sm-10 col-sm-offset-2 col-md-10 col-md-offset-2 main">
                    <ol class="breadcrumb">
                        <li><a href="#">Home</a></li>
                        <li><a href="#">ownCloud</a></li>
                        <li class="active">Introdução</li>
                    </ol>
                    
                    <div class="jumbotron">
                        <h1 id="tituloTopico">Título do Tópico</h1>
                    </div>
                    
                </div>
            </div>
            
        </div>
    </body>
    <script type="text/javascript" src="libs/jquery-1.11.1.min.js" ></script>
    <script type="text/javascript" src="index.js"></script>
    <script type="text/javascript" src="libs/bootstrap/js/bootstrap.min.js"></script>
</html>
