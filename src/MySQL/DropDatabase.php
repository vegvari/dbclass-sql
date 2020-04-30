<?php

namespace DBClass\MySQL;

class DropDatabase implements Interfaces\DDLStatement
{
    private $databaseName;
    private $ifExists = false;

    final public function __construct(string $databaseName)
    {
        $this->databaseName = $databaseName;
    }

    final public function getDatabaseName(): string
    {
        return $this->databaseName;
    }

    final public function getName(): string
    {
        return $this->databaseName;
    }

    final public function ifExists(): self
    {
        $this->ifExists = true;
        return $this;
    }

    final public function getIfExists(): bool
    {
        return $this->ifExists;
    }

    final public function getBuild(): string
    {
        $build[] = 'DROP DATABASE';

        if ($this->getIfExists()) {
            $build[] = 'IF EXISTS';
        }

        $build[] = sprintf('`%s`', $this->getDatabaseName());

        return implode(' ', $build);
    }
}
