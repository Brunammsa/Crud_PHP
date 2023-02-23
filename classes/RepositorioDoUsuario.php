<?php

namespace Bruna\Classes;

class RepositorioDoUsuario
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
        if(!file_exists('listaUsuarios.csv')) {
            $arquivoUsuarios = fopen('listaUsuarios.csv', 'w');
            $cabecalho = ['ID', 'NOME', 'CPF'];

            fputcsv($arquivoUsuarios, $cabecalho);
            fclose($arquivoUsuarios);
        }

        if(!file_exists('ultimoId.txt')) {
            $arquivoUltimoId = fopen('ultimoId.txt', 'w');
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

        $linhasUsuarios = file('listaUsuarios.csv');

        foreach ($linhasUsuarios as $linha) {
            $elementoId = str_getcsv($linha);
        }
        
        $arquivoUltimoId = fopen('ultimoId.txt', 'w');
        fwrite($arquivoUltimoId, $elementoId[0]);

        fclose($arquivoUltimoId);
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