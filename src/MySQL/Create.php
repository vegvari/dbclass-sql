<?php

namespace DBClass\SQL\MySQL;

abstract class Create
{
    public static function database(string $database, string $charset = null, string $collation = null): Interfaces\CreateDatabase
    {
        return new CreateDatabase($database, $charset, $collation);
    }
}
