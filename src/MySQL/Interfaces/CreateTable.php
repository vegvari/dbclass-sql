<?php

namespace DBClass\SQL\MySQL\Interfaces;

interface CreateTable extends DDLStatement, Name, IfNotExists, Charset, Collation, Comment
{
    const DEFAULT_ENGINE = 'InnoDB';

    public function setDatabaseName(?string $database_name = null);
    public function getDatabaseName(): ?string;
    public function hasDatabaseName(): bool;

    public function setEngine(string $engine = self::DEFAULT_ENGINE);
    public function getEngine(): string;
}
