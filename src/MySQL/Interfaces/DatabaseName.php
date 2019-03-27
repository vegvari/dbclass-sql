<?php

namespace DBClass\SQL\MySQL\Interfaces;

interface DatabaseName
{
    public function setDatabaseName(?string $database_name = null);
    public function getDatabaseName(): ?string;
    public function hasDatabaseName(): bool;
}
