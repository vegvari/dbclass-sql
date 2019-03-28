<?php

namespace DBClass\MySQL\Interfaces;

interface DropTable extends DDLStatement
{
    public function setName(string $name);
    public function getName(): string;

    public function setDatabaseName(?string $database_name = null);
    public function getDatabaseName(): ?string;
    public function hasDatabaseName(): bool;

    public function setIfExists(bool $value);
    public function getIfExists(): bool;
    public function ifExists();
}
