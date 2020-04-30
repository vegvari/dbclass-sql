<?php

namespace DBClass\MySQL;

abstract class Drop
{
    final public static function database(string $databaseName): Interfaces\DDLStatement
    {
        return new DropDatabase($databaseName);
    }

    final public static function databaseIfExists(string $databaseName): Interfaces\DDLStatement
    {
        return (new DropDatabase($databaseName))->setIfExists();
    }

    final public static function table(string $tableName): Interfaces\DDLStatement
    {
        return new DropTable($tableName);
    }

    final public static function tableIfExists(string $tableName): Interfaces\DDLStatement
    {
        return (new DropTable($tableName))->setIfExists();
    }
}
