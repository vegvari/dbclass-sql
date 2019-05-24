<?php

namespace DBClass\MySQL\Interfaces;

interface Column extends Name, DatabaseName, TableName
{
    public function setType(string $type);
    public function getType(): string;
    public function isTypeValid(string $type): bool;

    public function setNullable(bool $nullable = true);
    public function isNullable(): bool;

    public function isAutoIncrement(): bool;

    public function setComment(?string $comment = null);
    public function getComment(): ?string;
    public function hasComment(): bool;

    public function getBuild(): string;
}
