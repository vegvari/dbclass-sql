<?php

namespace DBClass\SQL\MySQL\Traits;

trait Unsigned
{
    private $unsigned = false;

    final public function setUnsigned(bool $unsigned = true): self
    {
        $this->unsigned = $unsigned;
        return $this;
    }

    final public function isUnsigned(): bool
    {
        return $this->unsigned;
    }
}
