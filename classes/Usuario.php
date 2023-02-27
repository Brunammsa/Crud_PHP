<?php

namespace Bruna\Classes;

use LengthException;

class Usuario
{
    use EntidadeTrait;
/*
    usar a trait é o mesmo que importar a função para a classe:
    
    public function setId(Id $id): void
    {
        $this->id = $id;
    }
*/
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

    public function usuarioCsv(): string
    {
        return "{$this->id},{$this->nome},{$this->cpf}";
    }

 
    public function __toString()
    {
        return "ID: {$this->id}, Nome: {$this->nome}, CPF: {$this->cpf}";
    }
}