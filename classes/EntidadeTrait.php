<?php

namespace Bruna\Classes;

trait EntidadeTrait
{
    public function setId(Id $id): void
    {
        $this->id = $id;
    }
}
