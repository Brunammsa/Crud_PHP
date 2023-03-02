<?php

namespace Bruna\CrudPhp\Excecoes;

use DomainException;

class ErroAoInserirUsuarioException extends DomainException
{
    public function __construct(string $nomeUsuario)
    {
        $mensagem = "Você tentou inserir o usuário $nomeUsuario, mas algo deu errado!" . PHP_EOL;
        parent::__construct($mensagem);
    }

}