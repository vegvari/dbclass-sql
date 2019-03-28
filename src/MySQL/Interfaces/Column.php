<?php

namespace DBClass\MySQL\Interfaces;

interface Column
{
    public function setName(string $name);
    public function getName(): string;

    public function setDatabaseName(?string $database_name = null);
    public function getDatabaseName(): ?string;
    public function hasDatabaseName(): bool;

    public function setTableName(?string $table_name = null);
    public function getTableName(): ?string;
    public function hasTableName(): bool;

    public function setType(string $type);
    public function getType(): string;
    public function isTypeValid(string $type): bool;

    public function setUnsigned(bool $unsigned = true);
    public function isUnsigned(): bool;

    public function setNullable(bool $nullable = true);
    public function isNullable(): bool;

    public function setAutoIncrement(bool $value);
    public function isAutoIncrement(): bool;

    public function setComment(?string $comment = null);
    public function getComment(): ?string;
    public function hasComment(): bool;

    public function getBuild(): string;
}
