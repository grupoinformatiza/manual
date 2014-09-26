<?php 
define('ROOT_PATH', '../../');
require "../config.php";
?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Sobre</title>
        <link rel="stylesheet" href="../libs/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="../default.css" />
        
    </head>
    <body role="document">
        <?php require_once 'layout/cabecalho_simples.php';?>
        
        <div class="container">
            <div class="row">          
                <!-- Linha para o formulario de cadastro -->
                <div>
                    <h1>Sobre</h1>                
                                           
                    <h3>Equipe de desenvolvimento:</h3>
                    <br><br>
                    <div class="row">
                        <div class="col-md-7 col-offset-2 imagem">
                            <img src="../imagens/equipe_informatiza.jpg" class=" img-responsive img-rounded">
                        </div>
                        <br><br>                            
                    </div>
                    
                    <div class="col-md-3 col-md-offset-1">
                        <h4>Raphael Garnica</h4>
                        <h4>Paulo Matheus Faria Cruz</h4>
                        <h4>Fabio Yoshio de Amorim</h4>
                        <h4>Ana Paula Suaiden</h4>
                        <h4>Luiz Carlos Mendonca Junior</h4>
                        <h4>Luís Fernando Simões</h4>
                        <h4>Matheus Henrique Lopes </h4>
                    </div> 
                    
                    <p>E-mail para contato com a equipe de desenvolvimento: informatiza03@gmail.com </p>
                    
                    <p>Desenvolvimento de um sistema para compartilhamento de arquivos entre integrantes do Colégio Técnico Industrial – “Isaac Portal Roldán” – CTI.<br>

                        <h4>Composto por:</h4>

                        Um servidor Linux para compartilhar os dados e serviços do sistema;<br>
                        O software Samba para possibilitar a intereção e o compartilhamento de recursos entre o servidor e máquinas com o sistema operacional Windows;<br>
                        O ownCloud para oferecer a ferramenta na qual o usuário compartilhará os arquivos.<br>
                        Todos os componentes do sistema trabalharão para fornecer ao usuário uma maneira eficaz e poderosa de compartilhar arquivos, porém o software ownCloud será a única ferramenta com a qual o usuário interagirá, afim de facilitar o uso do servidor.</p>
                </div> <!-- col que envolve o formulario inteiro -->
            </div>
                 
            
        </div> <!-- /container -->
        
    </body>
    <script type="text/javascript" src="../../libs/jquery-1.11.1.min.js" ></script>
    <script type="text/javascript" src="../../libs/bootstrap/js/bootstrap.min.js"></script>
    
    
</html>

