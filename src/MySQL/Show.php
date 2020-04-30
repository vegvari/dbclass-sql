<?php

namespace DBClass\MySQL;

abstract class Show
{
    final public static function createDatabase(string $databaseName): Interfaces\DDLStatement
    {
        return new ShowCreateDatabase($databaseName);
    }

    final public static function createTable(string $tableName): Interfaces\DDLStatement
    {
        return new ShowCreateTable($tableName);
    }
}
