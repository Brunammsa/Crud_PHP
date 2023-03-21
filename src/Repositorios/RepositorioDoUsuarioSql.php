<?php

namespace Bruna\CrudPhp\Repositorios;
use Bruna\CrudPhp\Entidades\Id;
use Bruna\CrudPhp\Entidades\Usuario;
use Bruna\CrudPhp\Excecoes\ErroAoEncontrarIdException;
use Bruna\CrudPhp\Interfaces\IRepositorioDoUsuario;
use PDO;

class RepositorioDoUsuarioSql implements IRepositorioDoUsuario
{
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function armazena(Usuario $usuario): void
    {
        $insertQuery = 'INSERT INTO usuarios (nome, cpf) VALUES (:nome, :cpf);';
        $statement = $this->connection->prepare($insertQuery);

        $success = $statement->execute([
            ':nome' => $nome,
            ':cpf' => $cpf,
        ]);
    }

    public function buscaPorId(int $id): ?Usuario
    {
        $sqlQuery = `SELECT * FROM usuarios WHERE id = ${id};`;

        return $sqlQuery;
    }

    public function listar(): array
    {
        $sqlQuery = 'SELECT * FROM usuarios;';
        $statement = $this->connection->query($sqlQuery);

        return $this->$statement;
    }

    public function atualizar(Usuario $usuario): bool
    {
        $updateQuery = 'INSERT INTO usuarios (nome, cpf) VALUES (:nome, :cpf);';
        $statement = $this->connection->prepare($updateQuery);

        $statement->bindValue(':nome', $usuario->getNome());
        $statement->bindValue(':cpf', $usuario->getCpf());
        $statement->bindValue(':id', $usuario->getId(), PDO::PARAM_INT);

        return $statement->execute();
    }

    public function remove(int $int): bool
    {
        $statement = $this->connection->prepare(`DELETE FROM usuarios WHERE id = ${int};`);

        return $statement->execute();
    }
}
