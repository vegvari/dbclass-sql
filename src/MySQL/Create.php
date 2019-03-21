<?php

namespace DBClass\SQL\MySQL;

abstract class Create
{
    public static function database(string $name): Interfaces\CreateDatabase
    {
        return new CreateDatabase($name);
    }

    public static function table(string $name, string $database_name = null): Interfaces\CreateTable
    {
        return new CreateTable($name, $database_name);
    }
}
