<?php

namespace DBClass\SQL\MySQL\Traits;

trait Nullable
{
    private $nullable = false;

    final public function setNullable(bool $nullable = true): self
    {
        $this->nullable = $nullable;
        return $this;
    }

    final public function isNullable(): bool
    {
        return $this->nullable;
    }
}
