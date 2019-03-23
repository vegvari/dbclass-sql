<?php

namespace DBClass\SQL\MySQL\Interfaces;

interface DropDatabase extends DDLStatement, Name
{
    public function setIfExists(bool $value): self;
    public function getIfExists(): bool;
    public function ifExists(): self;
}
