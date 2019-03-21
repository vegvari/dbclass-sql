<?php

namespace DBClass\SQL\MySQL;

use DBClass\SQL\MySQL\Interfaces;

final class DropDatabaseBuilder implements Interfaces\Builder
{
    public function getBuild(Interfaces\Statement $statement): string
    {
        $build[] = 'DROP DATABASE';

        if ($statement->getIfExists()) {
            $build[] = 'IF EXISTS';
        }

        $build[] = sprintf('`%s`', $statement->getName());

        return implode(' ', $build) . ';';
    }
}
