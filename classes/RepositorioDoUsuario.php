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
        $arquivoUsuarios = fopen('listaUsuarios.csv', 'w');
        fwrite($arquivoUsuarios, "ID, NOME, CPF\n");
        
        $arquivoId = fopen('ultimoId.txt', 'w');
        fwrite($arquivoId, 0);

        fclose($arquivoId);
        fclose($arquivoUsuarios);
    }

    /**
     * a função store recebe nome e cpf para serem inseridos no csv arquivoUsuarios
     * atualiza a quantidade de usuários no arquivoId
     */
    public function armazena(string $nome, string $cpf): void
    {
        $arquivoUsuarios = 'listaUsuarios.csv';

        $arquivoUsuarios = fopen($arquivoUsuarios, 'a+');

        $escrevendoUsuario = new Usuario($nome, $cpf);

        fwrite($arquivoUsuarios, $escrevendoUsuario);





        



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