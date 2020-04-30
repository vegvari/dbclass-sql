<?php

namespace DBClass\MySQL\Interfaces;

interface DropDatabase extends DDLStatement, Name
{
    public function ifExists();
    public function getIfExists(): bool;
}
