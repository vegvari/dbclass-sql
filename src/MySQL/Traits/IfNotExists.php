<?php

namespace DBClass\SQL\MySQL\Traits;

trait IfNotExists
{
    private $if_not_exists = false;

    final public function setIfNotExists(bool $value): self
    {
        $this->if_not_exists = $value;
        return $this;
    }

    final public function getIfNotExists(): bool
    {
        return $this->if_not_exists;
    }

    final public function ifNotExists(): self
    {
        return $this->setIfNotExists(true);
    }
}
