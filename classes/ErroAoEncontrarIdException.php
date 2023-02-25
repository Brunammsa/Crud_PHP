<?php

namespace Bruna\Classes;

use DomainException;

class ErroAoEncontrarIdException extends DomainException
{
    public function __construct()
    {
        $mensagem = "Este ID não existe" . PHP_EOL;
        parent::__construct($mensagem);
    }

}