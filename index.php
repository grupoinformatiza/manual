<?php 
//require "incluir/config.php";
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Manual Informatiza</title>
        
        
    </head>
    <body>
        <input type="button" id="botao" value="Clique em mim" />
        <div id="teste"></div>
    </body>
    <script type="text/javascript" src="libs/jquery-1.11.1.min.js" ></script>
    <script language="Javascript" type="text/javascript">
        $(document).ready(function(){
            $("#botao").click(function(){
                $.post(
                    "incluir/config.php",
                    {tipo: 'teste'},
                    function(retorno){
                        if(retorno){
                            $('#teste').text(retorno.teste);
                            alert(retorno.outro);
                        }else
                            alert('erro');
                    },
                    'json'
                );
            });
        });
    </script>
</html>
