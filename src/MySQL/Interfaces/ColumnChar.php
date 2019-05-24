<?php

namespace DBClass\MySQL\Interfaces;

interface ColumnChar extends Column
{
    public function setLength(int $length);
    public function getLength(): int;

    public function setDefault(?string $value = null);
    public function getDefault(): string;
    public function hasDefault(): bool;
}
