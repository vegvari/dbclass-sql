<?php

namespace DBClass\MySQL\Interfaces;

interface CreateDatabase extends DDLStatement, Name
{
    public function setIfNotExists(bool $value);
    public function getIfNotExists(): bool;
    public function ifNotExists();

    public function setCharset(string $charset = self::DEFAULT_CHARSET);
    public function getCharset(): string;

    public function setCollation(string $collation = self::DEFAULT_COLLATION);
    public function getCollation(): string;
}
