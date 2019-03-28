<?php

namespace DBClass\MySQL;

abstract class Create
{
    final public static function database(string $name): Interfaces\DDLStatement
    {
        return new CreateDatabase($name);
    }

    final public static function table(string $name, ?string $database_name = null): Interfaces\DDLStatement
    {
        return new CreateTable($name, $database_name);
    }
}
