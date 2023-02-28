<?php

namespace Bruna\Classes\Traits;

use Bruna\Classes\Entidades\Id;

trait EntidadeTrait
{
    public function setId(Id $id): void
    {
        $this->id = $id;
    }
}
