<?php

namespace DBClass\MySQL;

use DBClass\MySQL\Interfaces;

final class CreateTableBuilder implements Interfaces\Builder
{
    public function getBuild(Interfaces\Statement $statement): string
    {
        $build[] = 'CREATE TABLE';

        if ($statement->getIfNotExists()) {
            $build[] = 'IF NOT EXISTS';
        }

        $name = sprintf('`%s`', $statement->getName());
        if ($statement->hasDatabaseName()) {
            $name = sprintf('`%s`.', $statement->getDatabaseName()) . $name;
        }
        $build[] = $name;

        $build[] = sprintf('ENGINE `%s`', $statement->getEngine());
        $build[] = sprintf('CHARACTER SET `%s`', $statement->getCharset());
        $build[] = sprintf('COLLATE `%s`', $statement->getCollation());

        if ($statement->hasComment()) {
            $build[] = sprintf('COMMENT \'%s\'', $statement->getComment());
        }

        return implode(' ', $build) . ';';
    }
}
