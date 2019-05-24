<?php

namespace DBClass\MySQL\Interfaces;

interface DropTable extends DDLStatement, Name, DatabaseName
{
    public function setIfExists(bool $value);
    public function getIfExists(): bool;
    public function ifExists();
}
