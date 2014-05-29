<?php
namespace manual;

spl_autoload_extensions(".class.php");
spl_autoload_register();

$r = Registry::getInstancia();

$conexao = new PDO();

$r->set("con", $conexao);

