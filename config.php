<?php
//Habilitando carregamento automatico de classes
spl_autoload_register(
        function($class) { 
            require(str_replace('\\', '/', $class).'.class.php');
        }
 );


if(isset($_POST['tipo']) && $_POST['tipo'] == 'teste'){
    $retorno['teste'] = 'Resposta vindo do PHP';
    $retorno['outro'] = 'Neste exemplo utilizamos o formato JSON para retorno do PHP para Javascript.';
    die(json_encode($retorno));
}

use \incluir\Registry;
//Exemplo de utilização do Registry.
//Buscando instancia do registro
$r = Registry::getInstancia();
//Abrindo conexão com o banco de dados (A conexao nao sera assim, ficara numa classe nossa. este é um exemplo);
//$conexao = new PDO("pgsql:host=127.0.0.1;dbname=celulares", "postgres", "senha");
//Armazenando conexão no registro
//$r->set("con", $conexao);


//Quando precisar da conexão em outro arquivo:
//$cnn = $r->get("con");
