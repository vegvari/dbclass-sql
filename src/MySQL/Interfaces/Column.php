<?php

namespace DBClass\MySQL\Interfaces;

interface Column
{
    public function setType(string $type): self;
    public function getType(): string;
    public function isTypeValid(string $type): bool;
    public function setAutoIncrement(bool $value): self;
    public function isAutoIncrement(): bool;
    public function getBuild(): string;
}
