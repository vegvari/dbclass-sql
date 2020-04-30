<?php

namespace DBClass\MySQL;

abstract class Create
{
    final public static function database(string $databaseName): Interfaces\DDLStatement
    {
        return new CreateDatabase($databaseName);
    }

    final public static function databaseIfNotExists(string $databaseName): Interfaces\DDLStatement
    {
        return (new CreateDatabase($databaseName))->setIfNotExists();
    }

    final public static function table(string $tableName): Interfaces\DDLStatement
    {
        return new CreateTable($tableName);
    }

    final public static function tableIfNotExists(string $tableName): Interfaces\DDLStatement
    {
        return (new CreateTable($tableName))->setIfNotExists();
    }
}
