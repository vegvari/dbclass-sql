<?php

namespace DBClass\MySQL\Traits;

trait DatabaseName
{
    private $databaseName;

    final public function setDatabaseName(?string $databaseName = null): self
    {
        $this->databaseName = $databaseName;
        return $this;
    }

    final public function getDatabaseName(): ?string
    {
        return $this->databaseName;
    }

    final public function hasDatabaseName(): bool
    {
        return $this->databaseName !== null;
    }
}
