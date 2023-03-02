<?php

namespace Bruna\CrudPhp\Entidades;
use InvalidArgumentException;

final class Cpf
{
    public string $numero;
    
    public function __construct(
        string $numero
    )
    {
        $this->numero = $numero;
        
        $numero =  filter_var($numero, FILTER_VALIDATE_REGEXP, [
            'options' => [
                'regexp' => '/^[0-9]{3}\.[0-9]{3}\.[0-9]{3}\-[0-9]{2}$/'
            ]
        ]);

        if ($numero === false) {
            throw new InvalidArgumentException('Cpf inválido' . PHP_EOL);
        }

    }

    public function __toString()
    {
        return $this->numero;
    }

}