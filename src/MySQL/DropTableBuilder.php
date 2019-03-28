<?php

namespace DBClass\MySQL;

use DBClass\MySQL\Interfaces;

final class DropTableBuilder implements Interfaces\Builder
{
    public function getBuild(Interfaces\Statement $statement): string
    {
        $build[] = 'DROP TABLE';

        if ($statement->getIfExists()) {
            $build[] = 'IF EXISTS';
        }

        $name = sprintf('`%s`', $statement->getName());
        if ($statement->hasDatabaseName()) {
            $name = sprintf('`%s`.', $statement->getDatabaseName()) . $name;
        }
        $build[] = $name;

        return implode(' ', $build) . ';';
    }
}
