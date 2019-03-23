<?php

namespace DBClass\SQL\MySQL\Traits;

trait Name
{
    private $name;

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
