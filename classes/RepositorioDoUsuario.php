<?php

namespace Bruna\Classes;

class RepositorioDoUsuario
{
    private int $id;
    
    public function __construct()
    {
        $this->initializeFile();
    }

    private function initializeFile(): void
    {

    }

    /**
     * a função store recebe nome e cpf e retorna true se for 
     * inserido usuário ou false se não
     */
    public function store(string $name, string $cpf): void
    {
    }

    public function show(int $id): ?Usuario
    {
        

    }

    /**
     * @return array | Usuario[]
     */
    public function index(): array
    {
        
    }

    public function update(Usuario $usuario): bool
    {

    }


    public function remove(int $id): bool
    {

    }
}