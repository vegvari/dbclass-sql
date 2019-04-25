<?php

namespace DBClass\MySQL\Interfaces;

interface ColumnInt extends Column
{
    public function setUnsigned(bool $unsigned = true);
    public function isUnsigned(): bool;

    public function setDigits(?int $digits = null);
    public function getDigits(): int;

    public function setAutoIncrement(bool $value = true);
    public function isAutoIncrement(): bool;

    public function setDefault(?int $value = null);
    public function getDefault(): int;
    public function hasDefault(): bool;
}
