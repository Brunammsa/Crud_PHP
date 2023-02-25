<?php

namespace Bruna\Classes;

use LengthException;

class Usuario
{
    public Id $id;
    protected string $nome;
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

    static public function validaNome(string $name): void
    {
        if(strlen($name) <= 0) {
            throw new LengthException('Nome inválido' . PHP_EOL);
        }
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    static public function usuarioFormatado(int $id, string $nome, string $cpf): string
    {
        return "ID: $id, Nome: $nome, CPF: $cpf\n";
    }

    public function __toString()
    {
        return "{$this->id}, {$this->nome}, {$this->cpf}";
    }
}