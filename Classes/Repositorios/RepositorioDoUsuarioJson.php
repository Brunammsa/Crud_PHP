<?php

namespace Bruna\Classes\Repositorios;
use Bruna\Classes\Entidades\Id;
use Bruna\Classes\Entidades\Usuario;
use Bruna\Classes\Excecoes\ErroAoEncontrarIdException;
use Bruna\Classes\Interfaces\IRepositorioDoUsuario;

class RepositorioDoUsuarioJson implements IRepositorioDoUsuario
{
    public function __construct()
    {
        $this->initializeFile();
    }

/**
 * inicializando arquivos id e lista de usuários com numeração de ids 0 e cabeçalho
 */
    private function initializeFile(): void
    {
        if(!file_exists('listaUsuarios.json')) {
            $arquivo = __DIR__. 'listaUsuarios.json';
            file_put_contents($arquivo, json_encode(array()));
        }

        if(!file_exists('ultimoId.txt')) {
            $arquivoUltimoId = fopen('ultimoId.txt', 'w');
            
            fwrite($arquivoUltimoId, 0);
            fclose($arquivoUltimoId);
        }
    }

    public function armazena(string $nome, string $cpf): void
    {
        
    }

    public function buscaPorId(int $id): ?Usuario
    {

    }

    public function listar(): array
    {

    }

    public function atualizar(Usuario $usuario): bool
    {

    }

    public function remove(int $id): bool
    {

    }
}