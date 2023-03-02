<?php

namespace Bruna\Classes\Interfaces;

use Bruna\Classes\Entidades\Usuario;

interface IRepositorioDoUsuario{

    public function armazena(string $nome, string $cpf): void;
    public function buscaPorId(int $id): ?Usuario;

    /**
     * @return array|Usuario[]
     */
    public function listar(): array;
    public function atualizar(Usuario $usuario): bool;
    public function remove(int $id): bool;
}
