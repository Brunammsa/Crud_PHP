<?php

namespace Bruna\Classes\Entidades;

class Id
{    
    public int $numeroId;
    static public ?int $ultimoId = null;
    
    public function __construct(?int $numero = null)
    {
        if (!is_null($numero)) {
            $this->numeroId = $numero;
            return ;
        }

        if (is_null(self::$ultimoId)) {
            self::$ultimoId = Id::getUltimoIdInserido() + 1;
        } else {
            self::$ultimoId += 1;
        }
        $this->numeroId = self::$ultimoId;
    }

    static public function getUltimoIdInserido(): int
    {
        $arquivoId = file('ultimoId.txt');

        foreach ($arquivoId as $id) {
            $numeroId = trim($id);
            return (int) $numeroId;
        }
    }


    public function __toString(): string
    {
        return (string) $this->numeroId;
    }
}