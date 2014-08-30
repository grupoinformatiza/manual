<?php

if(!defined('ROOT_PATH'))
    define('ROOT_PATH','../../');
//Habilitando carregamento automatico de classes
//set_include_path("../../");
spl_autoload_register(
    function($class) { 
        require(__NAMESPACE__ . str_replace('\\', '/', $class).'.class.php');
    }
 );

$sucesso = (isset($_GET['msg']))?urldecode($_GET['msg']):null;
if (session_status() == PHP_SESSION_NONE)
            session_start();


