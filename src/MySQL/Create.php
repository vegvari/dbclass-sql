<?php

namespace DBClass\SQL\MySQL;

abstract class Create
{
    public static function database(string $name, string $charset = null, string $collation = null): Interfaces\CreateDatabase
    {
        return new CreateDatabase($name, $charset, $collation);
    }

    public static function table(string $name, string $charset = null, string $collation = null): Interfaces\CreateTable
    {
        return new CreateTable($name, $charset, $collation);
    }
}
