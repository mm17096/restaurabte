<?php

function controllers_autoload($classname){
include 'controles/'.$classname.'.php';
}
spl_autoload_register('controllers_autoload');
?>