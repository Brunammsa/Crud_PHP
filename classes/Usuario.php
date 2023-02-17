<?php

namespace Bruna\Classes;

use LengthException;

class Usuario
{

    public function __construct(
        protected readonly string $name,
        private Cpf $cpf,
        public readonly int $id
    )
    {
        $this->validaNome($name);
    }

    public function getCpf(): string
    {
        return $this->cpf->numero;
    }

    final protected function validaNome(string $name): void
    {
        if(strlen($name) < 3) {
            throw new LengthException('Nome inválido, necessário nome com mais de 3 caractéres' . PHP_EOL);
        }
    }

    public function getNome(): string
    {
        return $this->name;
    }


    public function __toString()
    {
        return "Id: {$this-> id}, Nome: {$this->name}, CPF: {$this->cpf}";
    }
}