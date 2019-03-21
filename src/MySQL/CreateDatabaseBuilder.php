<?php

namespace DBClass\SQL\MySQL;

use DBClass\SQL\MySQL\Interfaces;

final class CreateDatabaseBuilder implements Interfaces\Builder
{
    public function getBuild(Interfaces\Statement $statement): string
    {
        $build[] = 'CREATE DATABASE';

        if ($statement->getIfNotExists()) {
            $build[] = 'IF NOT EXISTS';
        }

        $build[] = sprintf('`%s`', $statement->getName());
        $build[] = sprintf('CHARACTER SET `%s`', $statement->getCharset());
        $build[] = sprintf('COLLATE `%s`', $statement->getCollation());

        return implode(' ', $build) . ';';
    }
}
