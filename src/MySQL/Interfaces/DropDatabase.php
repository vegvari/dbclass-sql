<?php

namespace DBClass\MySQL\Interfaces;

interface DropDatabase extends DDLStatement
{
    public function getDatabaseName(): string;
    public function getName(): string;
    public function ifExists();
    public function getIfExists(): bool;
}
