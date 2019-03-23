<?php

namespace DBClass\SQL\MySQL\Traits;

trait Collation
{
    private $collation = self::DEFAULT_COLLATION;

    public function setCollation(string $collation = self::DEFAULT_COLLATION): self
    {
        $this->collation = $collation;
        return $this;
    }

    public function getCollation(): string
    {
        return $this->collation;
    }
}
