<?php
//Habilitando carregamento automatico de classes
//set_include_path("../../");
spl_autoload_register(
    function($class) { 
        require(__NAMESPACE__ . str_replace('\\', '/', $class).'.class.php');
    }
 );





