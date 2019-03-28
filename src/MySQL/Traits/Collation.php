<?php

namespace DBClass\MySQL\Traits;

trait Collation
{
    private $collation = self::DEFAULT_COLLATION;

    final public function setCollation(string $collation = self::DEFAULT_COLLATION): self
    {
        $this->collation = $collation;
        return $this;
    }

    final public function getCollation(): string
    {
        return $this->collation;
    }
}
