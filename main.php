<?php

require_once 'autoload.php';

use Bruna\Classes\Cpf;
use Bruna\Classes\ErroAoEncontrarIdException;
use Bruna\Classes\ErroAoInserirUsuarioException;
use Bruna\Classes\RepositorioDoUsuario;
use Bruna\Classes\Usuario;

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
            echo 'opção inválida' . PHP_EOL;
        }
    }
}


function adicionaUsuario(): void
{
    echo 'Adicionando usuario a listar' . PHP_EOL;
    echo "~~~~~~~~~~~~~~~~~~~~~~\n" . PHP_EOL;
    
    $repositorioUsuario = new RepositorioDoUsuario();
    $isValidCpf = false;

    while($isValidCpf == false) {
        $cpfUsuario = readline('Informe o CPF do usuário: ');
        $isValidCpf = true;
        try{
            $cpf = new Cpf($cpfUsuario);
        } catch (InvalidArgumentException $exception){
            echo $exception->getMessage();
            $isValidCpf = false;
        }
    }
    
    $nomeValido = false;

    while ($nomeValido == false) {
        $nomeUsuario = readline('Informe o nome do usuário: ');
        $nomeValido = true;
        try{
            Usuario::validaNome($nomeUsuario);
        } catch (LengthException $exception) {
            echo $exception->getMessage();
            $nomeValido = false;
        }
    }

    try {
        $repositorioUsuario->armazena($nomeUsuario, (string) $cpf);
        echo "usuário $nomeUsuario inserido com sucesso!\n" . PHP_EOL;
    } catch (ErroAoInserirUsuarioException $exception) {
        echo $exception->getMessage();
    }

}

function buscaUsuario(): void
{
    echo 'Encontrando usuario na listar' . PHP_EOL;
    echo "~~~~~~~~~~~~~~~~~~~~~~\n" . PHP_EOL;

    $repositorioUsuario = new RepositorioDoUsuario();

    $isValidId = false;

    while($isValidId == false) {
        $idUsuario = readline('Qual o ID do usuário que deseja encontrar? ');
        if (is_numeric($idUsuario)) {
            try {
                $usuarioEncontrado = $repositorioUsuario->mostraId($idUsuario);
                echo $usuarioEncontrado . PHP_EOL;
                $isValidId = true;
            } catch (ErroAoEncontrarIdException $exception) {
                echo $exception->getMessage();
                $isValidId = false;
            }
        } else {
            echo 'ID inválido, tente novamente' . PHP_EOL;
            $isValidId = false;
        }
    } 

}

function listarUsuarios(): void
{
    
}

function atualizaUsuario(): void
{

}

function removeUsuario(): void
{

}

main();