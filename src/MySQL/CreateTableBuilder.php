<?php

namespace DBClass\SQL\MySQL;

use DBClass\SQL\MySQL\Interfaces;

final class CreateTableBuilder implements Interfaces\Builder
{
    public function getBuild(Interfaces\Statement $statement): string
    {
        $build[] = 'CREATE TABLE';

        if ($this->exists === false) {
            $build[] = 'IF NOT EXISTS';
        }

        $build[] = sprintf('`%s`', $this->getName());
        $build[] = sprintf('ENGINE `%s`', $this->getEngine());
        $build[] = sprintf('CHARACTER SET `%s`', $this->getCharset());
        $build[] = sprintf('COLLATE `%s`', $this->getCollation());

        if ($this->hasComment()) {
            $build[] = sprintf('COMMENT \'%s\'', $this->getComment());
        }

        return implode(' ', $build) . ';';
    }
}
