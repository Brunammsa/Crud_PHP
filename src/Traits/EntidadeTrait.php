<?php

namespace Bruna\CrudPhp\Traits;

use Bruna\CrudPhp\Entidades\Id;

trait EntidadeTrait
{
    public function setId(Id $id): void
    {
        $this->id = $id;
    }
}
