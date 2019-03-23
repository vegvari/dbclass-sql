<?php

namespace DBClass\SQL\MySQL\Traits;

trait Name
{
    private $name;

    final public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    final public function getName(): string
    {
        return $this->name;
    }
}
