<?php

require_once 'autoload.php';

use Bruna\Classes\Repositorios\RepositorioDoUsuarioJson;
use Bruna\Classes\Entidades\Usuario;

$repositorio = new RepositorioDoUsuarioJson();
echo $repositorio->listar();