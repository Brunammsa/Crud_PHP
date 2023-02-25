<?php

require_once 'autoload.php';

use Bruna\Classes\Usuario;

$id = 2;
$linhasUsuarios = file('listaUsuarios.csv');

foreach ($linhasUsuarios as $linha) {
    $elementoId = str_getcsv($linha);

    if ($elementoId[0] == $id) {
        echo Usuario::usuarioFormatado($elementoId[0], $elementoId[1], $elementoId[2]);
    }
}