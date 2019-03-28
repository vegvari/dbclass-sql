<?php

namespace DBClass\MySQL\Interfaces;

interface DropDatabase extends DDLStatement
{
    public function setName(string $name);
    public function getName(): string;

    public function setIfExists(bool $value);
    public function getIfExists(): bool;
    public function ifExists();
}
