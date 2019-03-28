<?php

namespace DBClass\MySQL\Traits;

trait IfExists
{
    private $if_exists = false;

    final public function setIfExists(bool $value): self
    {
        $this->if_exists = $value;
        return $this;
    }

    final public function getIfExists(): bool
    {
        return $this->if_exists;
    }

    final public function ifExists(): self
    {
        return $this->setIfExists(true);
    }
}
