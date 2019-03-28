<?php

namespace DBClass\MySQL\Interfaces;

interface Column
{
    const TYPES = [
        'tinyint',
        'smallint',
        'mediumint',
        'int',
        'bigint',
    ];

    public function setType(string $type): self;
    public function getType(): string;
    public function setAutoIncrement(bool $value): self;
    public function isAutoIncrement(): bool;
    public function getBuild(): string;
}
