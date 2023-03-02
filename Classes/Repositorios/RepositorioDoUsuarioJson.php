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
        $nomeArquivoUsuarios = 'listaUsuarios.json';

        if(!file_exists($nomeArquivoUsuarios)) {
            $arquivoUsuarios = fopen($nomeArquivoUsuarios, 'w');

            fwrite($arquivoUsuarios, json_encode([]));
            fclose($arquivoUsuarios);
        }

        $nomeArquivoId = 'ultimoId.txt';

        if(!file_exists($nomeArquivoId)) {
            $arquivoUltimoId = fopen($nomeArquivoId, 'w');
            
            fwrite($arquivoUltimoId, 0);
            fclose($arquivoUltimoId);
        }
    }

    public function armazena(string $nome, string $cpf): void
    {
        $nomeArquivoUsuarios = 'listaUsuarios.json';
        $conteudoDoArquivo = file_get_contents($nomeArquivoUsuarios);
        $listaDeUsuarios = json_decode($conteudoDoArquivo, true);

        $usuario = new Usuario($nome, $cpf);
        $listaDeUsuarios[] = $usuario;

        $arquivo = fopen($nomeArquivoUsuarios, 'w');
        fwrite($arquivo, json_encode($listaDeUsuarios));
        fclose($arquivo);

        $arquivoUltimoId = fopen('ultimoId.txt', 'w');
        fwrite($arquivoUltimoId, $usuario->getId());

        fclose($arquivoUltimoId);   
    }

    public function buscaPorId(int $id): ?Usuario
    {
        $nomeArquivoUsuarios = 'listaUsuarios.json';
        $conteudoDoArquivo = file_get_contents($nomeArquivoUsuarios);
        $listaDeUsuariosJson = json_decode($conteudoDoArquivo, true);
        
        foreach ($listaDeUsuariosJson as $linha) {
            if ($linha['id'] == $id) {
                $usuario = new Usuario($linha['nome'], $linha['cpf']);
                $usuario->setId(new Id((int)$linha['id']));

                return $usuario;
            }
        }
        throw new ErroAoEncontrarIdException();
        return null;
    }

    public function listar(): array
    {
        $nomeArquivoUsuarios = 'listaUsuarios.json';
        $conteudoDoArquivo = file_get_contents($nomeArquivoUsuarios);
        $listaDeUsuariosJson = json_decode($conteudoDoArquivo);

        $listaDeUsuariosString = [];

        foreach ($listaDeUsuariosJson as $linha) {
            $usuario = new Usuario($linha->nome, $linha->cpf);
            $id = new Id($linha->id);
            $usuario->setId($id);
            $listaDeUsuariosString[] = $usuario;
        }

        return $listaDeUsuariosString;
    }

    public function atualizar(Usuario $usuario): bool
    {
        $nomeArquivoUsuarios = 'listaUsuarios.json';
        $conteudoDoArquivo = file_get_contents($nomeArquivoUsuarios);
        $listaDeUsuariosJson = json_decode($conteudoDoArquivo, true);

        $listaDeUsuariosAtualizada = [];
        
        foreach ($listaDeUsuariosJson as $linha) {

            if ($linha['id'] == $usuario->getId()) {
                $linha = $usuario;
            }
            $listaDeUsuariosAtualizada[] = $linha;
        }

        $arquivo = fopen($nomeArquivoUsuarios, 'w');
        fwrite($arquivo, json_encode($listaDeUsuariosAtualizada));
        fclose($arquivo);
        return true;
    }

    public function remove(int $id): bool
    {
        $nomeArquivoUsuarios = 'listaUsuarios.json';
        $conteudoDoArquivo = file_get_contents($nomeArquivoUsuarios);
        $listaDeUsuariosJson = json_decode($conteudoDoArquivo, true);

        $listaDeUsuariosAtualizada = [];
        
        foreach ($listaDeUsuariosJson as $linha) {

            if ($linha['id'] !== $id) {
                $listaDeUsuariosAtualizada[] = $linha;
            }
        }

        $arquivo = fopen($nomeArquivoUsuarios, 'w');
        fwrite($arquivo, json_encode($listaDeUsuariosAtualizada));
        fclose($arquivo);
        return true;
    }
}