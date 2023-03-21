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
            ':nome' => $usuario->getNome(),
            ':cpf' => $usuario->getCpf(),
        ]);
    }

    public function buscaPorId(int $id): ?Usuario
    {
        $sqlQuery = 'SELECT * FROM usuarios WHERE id = :id;';
        $statement = $this->connection->prepare($sqlQuery);
        $statement->bindValue(':id', $id);
        $success = $statement->execute();

        if (!$success) {
            return null;
        }

        $resultado = $statement->fetch();
        
        if (!$resultado) {
            return null;
        }

        $usuario = new Usuario(
            $resultado['nome'],
            $resultado['cpf']
        );

        $usuario->setId($id);

        return $usuario;
    }

    public function listar(): array
    {
        $sqlQuery = 'SELECT * FROM usuarios;';
        $statement = $this->connection->query($sqlQuery);
        $resultado = $statement->fetchAll();

        $listaUsuarios = [];

        foreach ($resultado as $resultadoUsuarios) {

            $usuario = new Usuario(
                $resultadoUsuarios['nome'],
                $resultadoUsuarios['cpf']
            );
            $usuario->setId($resultadoUsuarios['id']);
            $listaUsuarios[] = $usuario;
        }

        return $listaUsuarios;
    }

    public function atualizar(Usuario $usuario): bool
    {
        $updateQuery = 'UPDATE usuarios SET nome = :nome,  cpf = :cpf WHERE id = :id;';

        $statement = $this->connection->prepare($updateQuery);

        $statement->bindValue(':nome', $usuario->getNome());
        $statement->bindValue(':cpf', $usuario->getCpf());
        $statement->bindValue(':id', $usuario->getId(), PDO::PARAM_INT);

        return $statement->execute();
    }

    public function remove(int $id): bool
    {
        $deleteQuery = 'DELETE FROM usuarios WHERE id = :id;';
        $statement = $this->connection->prepare($deleteQuery);
        $statement->bindValue(':id', $id);
        return $statement->execute();
    }
}
