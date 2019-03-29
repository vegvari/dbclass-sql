<?php

namespace DBClass\MySQL\Interfaces;

interface ColumnDateTime extends Column
{
    public function setDefault(?string $value = null);
    public function setDefaultCurrent(bool $value = true);
    public function getDefault(): string;
    public function hasDefault(): bool;
    public function isDefaultCurrent(): bool;

    public function setOnUpdateCurrent(bool $value = true);
    public function isOnUpdateCurrent(): bool;
}
