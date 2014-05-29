<?php

namespace incluir;
use PDO;
//Exemplo de utilização do Registry.

//Habilitando carregamento automatico de classes
spl_autoload_extensions(".class.php");
spl_autoload_register();

//Buscando instancia do registro
$r = Registry::getInstancia();
//Abrindo conexão com o banco de dados (A conexao nao sera assim, ficara numa classe nossa. este é um exemplo);
$conexao = new PDO("pgsql:host=127.0.0.1;dbname=celulares", "postgres", "senha");
//Armazenando conexão no registro
$r->set("con", $conexao);


//Quando precisar da conexão em outro arquivo:
$d = Registry::getInstancia();
$cnn = $d->get("con");
