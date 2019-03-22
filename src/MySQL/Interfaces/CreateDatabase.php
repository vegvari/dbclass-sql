<?php

namespace DBClass\SQL\MySQL\Interfaces;

interface CreateDatabase extends DDLStatement
{
    public function setName(string $name): self;
    public function getName(): string;

    public function setIfNotExists(bool $value): self;
    public function getIfNotExists(): bool;
    public function ifNotExists(): self;

    public function setCharset(string $charset = self::DEFAULT_CHARSET): self;
    public function getCharset(): string;

    public function setCollation(string $collation = self::DEFAULT_COLLATION): self;
    public function getCollation(): string;
}
