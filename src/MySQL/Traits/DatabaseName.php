<?php

namespace DBClass\SQL\MySQL\Traits;

trait DatabaseName
{
    private $database_name;

    final public function setDatabaseName(?string $database_name = null): self
    {
        $this->database_name = $database_name;
        return $this;
    }

    final public function getDatabaseName(): ?string
    {
        return $this->database_name;
    }

    final public function hasDatabaseName(): bool
    {
        return $this->database_name !== null;
    }
}
