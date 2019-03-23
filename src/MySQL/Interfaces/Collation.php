<?php

namespace DBClass\SQL\MySQL\Interfaces;

interface Collation
{
    const DEFAULT_COLLATION = 'utf8mb4_unicode_ci';

    public function setCollation(string $collation = self::DEFAULT_COLLATION);
    public function getCollation(): string;
}
