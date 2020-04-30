<?php

namespace DBClass\MySQL;

final class ShowCreateDatabase implements Interfaces\DDLStatement
{
    private $databaseName;

    public function __construct(string $databaseName)
    {
        $this->databaseName = $databaseName;
    }

    public function getDatabaseName(): string
    {
        return $this->databaseName;
    }

    public function getName(): string
    {
        return $this->databaseName;
    }

    public function getBuild(): string
    {
        $build[] = 'SHOW CREATE DATABASE';
        $build[] = sprintf('`%s`', $this->getDatabaseName());
        return implode(' ', $build);
    }
}
