<?php

namespace DBClass\SQL\MySQL\Interfaces;

interface CreateDatabase extends DDLStatement
{
    const DEFAULT_CHARSET = 'utf8mb4';
    const DEFAULT_COLLATION = 'utf8mb4_unicode_ci';

    public function setDatabase(string $database): self;
    public function getDatabase(): string;
    public function setCharset(?string $charset = null): self;
    public function getCharset(): string;
    public function setCollation(?string $collation = null): self;
    public function getCollation(): string;
    public function ifExists(): self;
    public function ifNotExists(): self;
}
