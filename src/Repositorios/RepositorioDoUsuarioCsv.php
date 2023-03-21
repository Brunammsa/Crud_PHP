<?php

namespace Bruna\CrudPhp\Repositorios;

use Bruna\CrudPhp\Entidades\Id;
use Bruna\CrudPhp\Entidades\Usuario;
use Bruna\CrudPhp\Excecoes\ErroAoEncontrarIdException;
use Bruna\CrudPhp\Interfaces\IRepositorioDoUsuario;

class RepositorioDoUsuarioCsv implements IRepositorioDoUsuario
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
        $nomeDoArquivoUsuarios = 'listaUsuarios.csv';

        if(!file_exists($nomeDoArquivoUsuarios)) {
            $arquivoUsuarios = fopen($nomeDoArquivoUsuarios, 'w');
            $cabecalho = ['ID', 'NOME', 'CPF'];

            fputcsv($arquivoUsuarios, $cabecalho);
            fclose($arquivoUsuarios);
        }

        $nomeDoArquivoId = 'ultimoId.txt';
        
        if(!file_exists($nomeDoArquivoId)) {
            $arquivoUltimoId = fopen($nomeDoArquivoId, 'w');
            
            fwrite($arquivoUltimoId, 0);
            fclose($arquivoUltimoId);
        }
    }


    /**
     * a função armazena recebe nome e cpf para serem inseridos no csv arquivoUsuarios
     * atualiza a quantidade de usuários no arquivoId
     */
    public function armazena(string $nome, string $cpf): void
    {
        $arquivoUsuariosAtt = fopen('listaUsuarios.csv', 'a');
        $escrevendoUsuario = new Usuario($nome, $cpf);

        fputcsv($arquivoUsuariosAtt, (array)$escrevendoUsuario);
        fclose($arquivoUsuariosAtt);

        $arquivoUltimoId = fopen('ultimoId.txt', 'w');
        fwrite($arquivoUltimoId, $escrevendoUsuario->id);

        fclose($arquivoUltimoId);
    }

    /**
     * percorrer o arquivo de usuários até encontrar a pessoa com o mesmo ID recebido
     */
    public function buscaPorId(int $id): ?Usuario
    {
        $linhasUsuarios = file('listaUsuarios.csv');

        foreach ($linhasUsuarios as $linha) {
            $elementoId = str_getcsv($linha);

            if ($elementoId[0] == $id) {
                $usuario = new Usuario($elementoId[1], $elementoId[2]);
                $usuario->setId(new Id((int)$elementoId[0]));
                return $usuario;
            }
        } 
        throw new ErroAoEncontrarIdException();
        return null;
    }

    /**
     * @return array | Usuario[]
     */
    public function listar(): array
    {
        $listaDeUsuarios = [];
        $arquivo = file('listaUsuarios.csv');

        foreach ($arquivo as $numeroLinha => $linha) {
            if ($numeroLinha === 0) {
                continue;
            }
            $linhacsv = str_getcsv($linha);
            $usuario = new Usuario($linhacsv[1], $linhacsv[2]);
            $usuario->setId(new Id((int)$linhacsv[0]));

            $listaDeUsuarios[] = $usuario;
        }
        return $listaDeUsuarios;
    }


    public function atualizar(Usuario $usuario): bool
    {
        $arquivoUsuarios = file('listaUsuarios.csv');
        $listaDeUsuarios = [];

        foreach ($arquivoUsuarios as $linha) {
            $linhaComoArray = str_getcsv($linha);

            if ((int)$linhaComoArray[0] === $usuario->getId()) {
                $linha = $usuario->usuarioCsv();
            }
            $listaDeUsuarios[] = $linha;
        }

        $arquivoUsuariosAtualizados = fopen('listaUsuarios.csv', 'w');
        foreach ($listaDeUsuarios as $linha) {
            fwrite($arquivoUsuariosAtualizados ,$linha);
        }
        return true;
    }


    public function remove(int $id): bool
    {
        $arquivoUsuarios = file('listaUsuarios.csv');
        $listaDeUsuarios = [];

        foreach ($arquivoUsuarios as $linha) {
            $linhaComoArray = str_getcsv($linha);

            if ((int)$linhaComoArray[0] !== $id) {
                $listaDeUsuarios[] = $linha;
            }
        }

        $arquivoUsuariosAtualizados = fopen('listaUsuarios.csv', 'w');
        foreach ($listaDeUsuarios as $linha) {
            fwrite($arquivoUsuariosAtualizados ,$linha);
        }
        return true;
    }
}