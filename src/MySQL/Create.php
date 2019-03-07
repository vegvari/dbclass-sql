<?php

namespace DBClass\SQL\MySQL;

abstract class Create
{
    public static function database(string $name): Interfaces\CreateDatabase
    {
        return new CreateDatabase($name);
    }

    public static function table(string $name): Interfaces\CreateTable
    {
        return new CreateTable($name);
    }
}
