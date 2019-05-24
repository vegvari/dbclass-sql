<?php

namespace DBClass\MySQL\Interfaces;

interface DropDatabase extends DDLStatement, Name
{
    public function setIfExists(bool $value);
    public function getIfExists(): bool;
    public function ifExists();
}
