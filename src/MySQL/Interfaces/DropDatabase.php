<?php

namespace DBClass\SQL\MySQL\Interfaces;

interface DropDatabase extends DDLStatement
{
    public function setName(string $name): self;
    public function getName(): string;
    public function ifExists(): self;
    public function ifNotExists(): self;
}
