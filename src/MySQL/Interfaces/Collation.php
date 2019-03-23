<?php

namespace DBClass\SQL\MySQL\Interfaces;

interface Collation
{
    public function setCollation(string $collation = self::DEFAULT_COLLATION);
    public function getCollation(): string;
}
