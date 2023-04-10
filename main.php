<?php

require 'vendor/autoload.php';

use Bruna\CrudPhp\Entidades\Cpf;
use Bruna\CrudPhp\Entidades\Usuario;
use Bruna\CrudPhp\Excecoes\ErroAoEncontrarIdException;
use Bruna\CrudPhp\Excecoes\ErroAoInserirUsuarioException;
use Bruna\CrudPhp\Repositorios\RepositorioDoUsuarioSql;
use Bruna\CrudPhp\Persistencia\ConnectionCreator;
use League\CLImate\CLImate;
use Brunammsa\Inputzvei\InputCpf;
use Brunammsa\Inputzvei\InputText;
use Brunammsa\Inputzvei\InputNumber;



function main(): void {
    echo '~~~~~~~~~~~~~~ Bem vindo(a) a NOX ~~~~~~~~~~~~~' . PHP_EOL;
    echo '~~~~~~~~~~~~~~~~~~ LISTA VIP ~~~~~~~~~~~~~~~~~~' . PHP_EOL;
    menu();
}


function menu(): void
{
    $opcao = null;

    while($opcao != 6 || $opcao == null) {

        echo 'Selecione uma das opções abaixo:' . PHP_EOL;
        echo "1 - Adicionar\n2 - Exibir\n3 - Listar\n4 - Alterar\n5 - Remover\n6 - Sair"  . PHP_EOL;

        $opcao = readline();

        if ($opcao == '1') {
            adicionaUsuario();
        } elseif ($opcao == '2') {
            buscaUsuario();
        } elseif ($opcao == '3') {
            listarUsuarios();
        } elseif ($opcao == '4') {
            atualizaUsuario();
        } elseif ($opcao == '5') {
            removeUsuario();
        } elseif ($opcao == '6') {
            exit();
        } else {
            $climate = new CLImate;
            $climate->red('opção inválida' . PHP_EOL); 
        }
    }
}


function adicionaUsuario(): void
{
    echo 'Adicionando usuario a listar' . PHP_EOL;
    echo "~~~~~~~~~~~~~~~~~~~~~~\n" . PHP_EOL;
    
    $pdo = ConnectionCreator::createConnection();
    $repositorioUsuario = new RepositorioDoUsuarioSql($pdo);

    $inputValido = false;

    $inputzVei = new InputCpf('Com apenas números, insira um cpf válido: ');
    $CpfAnswer = $inputzVei->ask();

    $inputzVei = new InputText('Informe o nome do usuário: ');
    $nameAnswer =  $inputzVei->ask();

    try {
        $usuario = new Usuario(cpf: $CpfAnswer, nome: $nameAnswer);
        $repositorioUsuario->armazena($usuario);
        $climate = new CLImate;
        $climate->green("usuário $nameAnswer inserido(a) com sucesso!\n" . PHP_EOL);
    } catch (ErroAoInserirUsuarioException $exception) {
        $climate = new CLImate;
        $climate->red($exception->getMessage());
    }

}

function buscaUsuario(): void
{
    echo 'Encontrando usuario na listar' . PHP_EOL;
    echo "~~~~~~~~~~~~~~~~~~~~~~\n" . PHP_EOL;

    $pdo = ConnectionCreator::createConnection();
    $repositorioUsuario = new RepositorioDoUsuarioSql($pdo);

    $inputzVei = new InputNumber('Qual o ID do usuário? ');
    $idAnswer = $inputzVei->ask();

    try {
        $usuarioEncontrado = $repositorioUsuario->buscaPorId($idAnswer);
        if (!$usuarioEncontrado) {
            throw new ErroAoEncontrarIdException();
        }
    
        $climate = new CLImate;
        $climate->green($usuarioEncontrado . PHP_EOL);

    } catch (ErroAoEncontrarIdException $exception) {
        $climate = new CLImate;
        $climate->red($exception->getMessage());                              
    }

}

function listarUsuarios(): void
{
    $pdo = ConnectionCreator::createConnection();
    $repositorioUsuario = new RepositorioDoUsuarioSql($pdo);
    $listaUsuarios = $repositorioUsuario->listar();

    foreach ($listaUsuarios as $linha) {
        $climate = new CLImate;
        $climate->green($linha . PHP_EOL);
    } 
}

function atualizaUsuario(): void
{
    $pdo = ConnectionCreator::createConnection();
    $repositorioUsuario = new RepositorioDoUsuarioSql($pdo);

    $inputzVei = new inputNumber('Digite o ID da pessoa que deseja atualizar: ');
    $idAnswer = $inputzVei->ask();

    try {
        $usuario = $repositorioUsuario->buscaPorId($idAnswer);
        if (!$usuario) {
            throw new ErroAoEncontrarIdException();
        }
    } catch (ErroAoEncontrarIdException $exception) {
        $climate = new CLImate;
        $climate->red($exception->getMessage());  
        return;
    }

    $inputzVei = new inputCpf('Com apenas números, qual o cpf atualizado? ');
    $cpfAnswer = $inputzVei->ask();

    try{
        $usuario->setCpf($cpfAnswer);
    } catch (InvalidArgumentException $exception){
        $climate = new CLImate;
        $climate->red($exception->getMessage());  
    }

    $inputzVei = new inputText('Qual o nome atualizado? ');
    $nameAnswer = $inputzVei->ask();

    try{
        $usuario->setNome($nameAnswer);
    } catch (LengthException $exception) {
        $climate = new CLImate;
        $climate->red($exception->getMessage());  
    }

    $usuarioAtualizado = $repositorioUsuario->atualizar($usuario);

    if ($usuarioAtualizado) {
        $climate = new CLImate;
        $climate->green('Usuário atualizado!' . PHP_EOL);  
    }
}


function removeUsuario(): void
{
    $pdo = ConnectionCreator::createConnection();
    $repositorioUsuario = new RepositorioDoUsuarioSql($pdo);

    $inputzVei = new inputNumber("Digite o ID da pessoa que deseja remover: ");
    $idAnswer = $inputzVei->ask();

    try {
        $usuario = $repositorioUsuario->buscaPorId($idAnswer);
        if (!$usuario) {
            throw new ErroAoEncontrarIdException();
        }
    } catch (ErroAoEncontrarIdException $exception) {
        $climate = new CLImate;
        $climate->red($exception->getMessage());
        return;
    }

    $usuarioRemovido = $repositorioUsuario->remove($idAnswer);

    if ($usuarioRemovido) {
        $climate = new CLImate;
        $climate->green('Usuário removido!' . PHP_EOL);
    }
}

main();