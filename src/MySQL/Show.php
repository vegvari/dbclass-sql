<?php

namespace DBClass\MySQL;

abstract class Show
{
    final public static function createDatabase(string $name): Interfaces\DDLStatement
    {
        return new ShowCreateDatabase($name);
    }

    final public static function createTable(string $name, ?string $database_name = null): Interfaces\DDLStatement
    {
        return new ShowCreateTable($name, $database_name);
    }
}
