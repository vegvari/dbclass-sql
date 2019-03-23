<?php

namespace DBClass\SQL\MySQL\Interfaces;

interface DropTable extends DDLStatement, Name
{
    public function setIfExists(bool $value): self;
    public function getIfExists(): bool;
    public function ifExists(): self;
}
