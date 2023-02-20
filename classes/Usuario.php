<?php

namespace Bruna\Classes;

use LengthException;

class Usuario
{
    public readonly Id $id;
    protected readonly string $nome;
    private Cpf $cpf;

    public function __construct(
        string $nome,
        string $cpf,
    )
    {
        $this->cpf = new Cpf($cpf);
        $this->nome = $nome;
        $this->validaNome($nome);
        $this->id = new Id();
    }

    /*
     * o mesmo construtor na sintaxe do php8
     * 
     * private Cpf $cpf;
     * 
     * public function __construct(
     *      protected readonly string $nome,
     *      protected string $cpf,  
     * )
     * {
     *      $this->cpf = new Cpf($cpf);
     *      $this->validaNome($nome);
     * }
     * 
     */

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
        return $this->nome;
    }

    public function __toString()
    {
        return "Id: {$this->id}, Nome: {$this->nome}, CPF: {$this->cpf}";
    }
}