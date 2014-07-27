<?php
//Habilitando carregamento automatico de classes
spl_autoload_register(
    function($class) { 
        require(str_replace('\\', '/', $class).'.class.php');
    }
 );





