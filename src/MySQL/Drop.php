<?php

namespace DBClass\MySQL;

abstract class Drop
{
    final public static function database(string $name): Interfaces\DDLStatement
    {
        return new DropDatabase($name);
    }

    final public static function table(string $name): Interfaces\DDLStatement
    {
        return new DropTable($name);
    }
}
