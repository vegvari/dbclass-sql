<?php

namespace DBClass\MySQL\Interfaces;

interface DropTable extends DDLStatement
{
    public function getDatabaseName(): string;
    public function hasDatabaseName(): bool;
    public function getTableName(): string;
    public function getName(): string;
    public function ifExists();
    public function getIfExists(): bool;
}
