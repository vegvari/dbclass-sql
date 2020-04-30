<?php

namespace DBClass\MySQL\Interfaces;

interface CreateDatabase extends DDLStatement
{
    public function setIfNotExists(bool $value = true);
    public function getIfNotExists(): bool;

    public function setCharset(string $charset = self::DEFAULT_CHARSET);
    public function getCharset(): string;

    public function setCollation(string $collation = self::DEFAULT_COLLATION);
    public function getCollation(): string;
}
