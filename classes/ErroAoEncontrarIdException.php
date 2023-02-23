<?php

namespace Bruna\Classes;

use DomainException;

class ErroAoEncontrarIdException extends DomainException
{
    public function __construct($id)
    {
        $mensagem = "O id $id não existe" . PHP_EOL;
        parent::__construct($mensagem);
    }

}