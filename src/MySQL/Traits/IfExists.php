<?php

namespace DBClass\MySQL\Traits;

trait IfExists
{
    private $ifExists = false;

    final public function ifExists(): self
    {
        $this->ifExists = true;
        return $this;
    }

    final public function getIfExists(): bool
    {
        return $this->ifExists;
    }
}
