<?php

namespace DBClass\SQL\MySQL;

use DBClass\SQL\MySQL\Interfaces;

final class DropTableBuilder implements Interfaces\Builder
{
    public function getBuild(Interfaces\Statement $statement): string
    {
        $build[] = 'DROP TABLE';

        if ($statement->getIfExists()) {
            $build[] = 'IF EXISTS';
        }

        $build[] = sprintf('`%s`', $statement->getName());

        return implode(' ', $build) . ';';
    }
}
