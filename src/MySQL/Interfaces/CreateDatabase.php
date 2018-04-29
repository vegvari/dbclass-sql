<?php

namespace DBClass\SQL\MySQL\Interfaces;

interface CreateDatabase extends DDLStatement
{
    public function setDatabase(string $database): self;
    public function getDatabase(): string;
    public function setCharset(string $charset): self;
    public function getCharset(): string;
    public function setCollation(string $collation): self;
    public function getCollation(): string;
    public function ifExists(): self;
    public function ifNotExists(): self;
}
