<?php

namespace DBClass\SQL\MySQL\Traits;

trait IfExists
{
    private $if_exists = false;

    public function setIfExists(bool $value): self
    {
        $this->if_exists = $value;
        return $this;
    }

    public function getIfExists(): bool
    {
        return $this->if_exists;
    }

    public function ifExists(): self
    {
        return $this->setIfExists(true);
    }
}
