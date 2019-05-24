<?php

namespace DBClass\MySQL\Interfaces;

interface TableName
{
    public function setTableName(?string $table_name = null);
    public function getTableName(): ?string;
    public function hasTableName(): bool;
}
