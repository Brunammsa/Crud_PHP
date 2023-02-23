<?php
require_once 'autoload.php';
use Bruna\Classes\Id;
use Bruna\Classes\Usuario;

$usuario = new Usuario('bruna', '111.111.111-11');

echo $usuario . PHP_EOL;