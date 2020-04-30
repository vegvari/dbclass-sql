<?php

namespace DBClass\MySQL;

class ShowCreateDatabase implements Interfaces\DDLStatement
{
    private $databaseName;

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

    final public function getBuild(): string
    {
        $build[] = 'SHOW CREATE DATABASE';
        $build[] = sprintf('`%s`', $this->getDatabaseName());
        return implode(' ', $build);
    }
}
