<?php

namespace DBClass\SQL\MySQL\Traits;

trait IfNotExists
{
    private $if_not_exists = false;

    public function setIfNotExists(bool $value): self
    {
        $this->if_not_exists = $value;
        return $this;
    }

    public function getIfNotExists(): bool
    {
        return $this->if_not_exists;
    }

    public function ifNotExists(): self
    {
        return $this->setIfNotExists(true);
    }
}
