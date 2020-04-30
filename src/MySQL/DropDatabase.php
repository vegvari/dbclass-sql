<?php

namespace DBClass\MySQL;

class DropDatabase implements Interfaces\DDLStatement
{
    use Traits\Name;
    use Traits\IfExists;

    final public function __construct(string $databaseName)
    {
        $this->setName($databaseName);
    }

    final public function getBuild(): string
    {
        $build[] = 'DROP DATABASE';

        if ($this->getIfExists()) {
            $build[] = 'IF EXISTS';
        }

        $build[] = sprintf('`%s`', $this->getName());

        return implode(' ', $build);
    }
}
