<?php

namespace DBClass\SQL\MySQL;

abstract class Create
{
    public static function database(string $database): Interfaces\CreateDatabase
    {
        return new CreateDatabase($database);
    }
}
