<?php

namespace DBClass\MySQL;

abstract class Drop
{
    final public static function database(string $name): Interfaces\DDLStatement
    {
        return new DropDatabase($name);
    }

    final public static function databaseIfExists(string $name): Interfaces\DDLStatement
    {
        return (new DropDatabase($name))->ifExists();
    }

    final public static function table(string $name, ?string $database_name = null): Interfaces\DDLStatement
    {
        return new DropTable($name, $database_name);
    }

    final public static function tableIfExists(string $name, ?string $database_name = null): Interfaces\DDLStatement
    {
        return (new DropTable($name, $database_name))->ifExists();
    }
}
