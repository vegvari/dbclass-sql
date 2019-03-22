<?php

namespace DBClass\SQL\MySQL\Traits;

use DBClass\SQL\MySQL\Interfaces;

trait Collation
{
    private $collation = self::DEFAULT_COLLATION;

    public function setCollation(string $collation = self::DEFAULT_COLLATION): Interfaces\Collation
    {
        $this->collation = $collation;
        return $this;
    }

    public function getCollation(): string
    {
        return $this->collation;
    }
}
