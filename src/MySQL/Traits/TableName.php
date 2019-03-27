<?php

namespace DBClass\SQL\MySQL\Traits;

trait TableName
{
    private $table_name;

    final public function setTableName(?string $table_name = null): self
    {
        $this->table_name = $table_name;
        return $this;
    }

    final public function getTableName(): ?string
    {
        return $this->table_name;
    }

    final public function hasTableName(): bool
    {
        return $this->table_name !== null;
    }
}
