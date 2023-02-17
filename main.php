<?php

require_once 'autoload.php';

use Bruna\Classes\Cpf;
use Bruna\Classes\Usuario;
use Bruna\Classes\UsuarioRepository;

function main(): void {
    echo '~~~~~~~~~~~~~~ Bem vindo(a) a NOX ~~~~~~~~~~~~~' . PHP_EOL;
    echo '~~~~~~~~~~~~~~~~~~ LISTA VIP ~~~~~~~~~~~~~~~~~~' . PHP_EOL;
    menu();
}


function menu(): void
{
    $option = null;

    while($option != 6 || $option == null) {

        echo 'Selecione uma das opções abaixo:' . PHP_EOL;
        echo "1 - Adicionar\n2 - Exibir\n3 - Listar\n4 - Alterar\n5 - Remover\n6 - Sair"  . PHP_EOL;

        $validOptions = ['1', '2', '3', '4', '5', '6'];
        $option = readline();

        if ($option == '1') {
            add();
        } elseif ($option == '2') {
            show();
        } elseif ($option == '3') {
            lista();
        } elseif ($option == '4') {
            update();
        } elseif ($option == '5') {
            remove();
        } elseif ($option == '6') {
            exit();
        } else {
            echo 'opção inválida' . PHP_EOL;
        }
    }
}



function add(): void
{
    echo 'Adicionar nome a lista' . PHP_EOL;
    echo "~~~~~~~~~~~~~~~~~~~~~~\n" . PHP_EOL;

    $cpf = null;
    $isValidCpf = false;

    while($isValidCpf == false) {
        $askCpf = readline('Informe o CPF do usuário: ');
        $isValidCpf = true;
        try{
            $cpf = new Cpf($askCpf);
        } catch (InvalidArgumentException $exception){
            echo $exception->getMessage();
            $isValidCpf = false;
        }
    }
    echo "ai papai" . PHP_EOL;
    die;

    while (true) {
        $askName = readline('Informe o nome do usuário: ');
        $usuario = new Usuario($askName, $cpf);

        if($usuario == true){
            die;
        }
    }
}

function show(): void
{

}

function lista(): void
{

}

function update(): void
{

}

function remove(): void
{

}

main();