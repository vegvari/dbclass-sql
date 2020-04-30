<?php

namespace DBClass\MySQL\Interfaces;

interface DropTable extends DDLStatement, Name, DatabaseName
{
    public function ifExists();
    public function getIfExists(): bool;
}
