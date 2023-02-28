<?php

require_once 'autoload.php';

use Bruna\Classes\Id;
use Bruna\Classes\RepositorioDoUsuario;
use Bruna\Classes\Usuario;

$repository = new RepositorioDoUsuario();

$repository->remove(3);