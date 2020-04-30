<?php

namespace DBClass\MySQL\Traits;

trait IfExists
{
    private $ifExists = false;

    final public function setIfExists(bool $value): self
    {
        $this->ifExists = $value;
        return $this;
    }

    final public function getIfExists(): bool
    {
        return $this->ifExists;
    }

    final public function ifExists(): self
    {
        return $this->setIfExists(true);
    }
}
