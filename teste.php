<?php

require_once 'autoload.php';

use Bruna\Classes\Repositorios\RepositorioDoUsuarioJson;
use Bruna\Classes\Entidades\Usuario;

$repositorio = new RepositorioDoUsuarioJson;
$usuario = new Usuario('bruno', '111.111.111-11');
echo $usuario . PHP_EOL;


echo json_encode($usuario) . PHP_EOL;