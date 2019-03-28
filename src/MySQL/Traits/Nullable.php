<?php

namespace DBClass\MySQL\Traits;

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
