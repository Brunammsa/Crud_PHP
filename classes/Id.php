<?php

namespace Bruna\Classes;

use InvalidArgumentException;

class Id
{    
    public readonly int $numeroId;
    static public ?int $ultimoId = null;
    
    public function __construct()
    {
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