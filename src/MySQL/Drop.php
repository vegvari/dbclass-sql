<?php

namespace DBClass\SQL\MySQL;

abstract class Drop
{
    public static function database(string $name): Interfaces\DropDatabase
    {
        return new DropDatabase($name);
    }

    public static function table(string $name): Interfaces\DropTable
    {
        return new DropTable($name);
    }
}
