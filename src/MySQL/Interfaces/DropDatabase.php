<?php

namespace DBClass\SQL\MySQL\Interfaces;

interface DropDatabase extends DDLStatement
{
    public function setName(string $name): self;
    public function getName(): string;

    public function setIfExists(bool $value): self;
    public function getIfExists(): bool;
    public function ifExists(): self;
}
