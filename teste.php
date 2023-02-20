<?php

require_once 'autoload.php';
use Bruna\Classes\Usuario;

$usuario1 = new Usuario('bruna', '123.122.123-00');
echo $usuario1 . PHP_EOL;

$usuario2 = new Usuario('anna', '123.122.123-00');
echo $usuario2 . PHP_EOL;
