<?php

namespace DBClass\MySQL;

class ShowCreateTable implements Interfaces\DDLStatement
{
    private $databaseName;
    private $tableName;
    private $ifExists = false;

    final public function __construct(string $tableName)
    {
        $this->tableName = $tableName;
    }

    final public function setDatabaseName(string $databaseName): self
    {
        $this->databaseName = $databaseName;
        return $this;
    }

    final public function getDatabaseName(): string
    {
        return $this->databaseName;
    }

    final public function hasDatabaseName(): bool
    {
        return $this->databaseName !== null;
    }

    final public function getTableName(): string
    {
        return $this->tableName;
    }

    final public function getName(): string
    {
        return $this->tableName;
    }

    final public function getBuild(): string
    {
        $build[] = 'SHOW CREATE TABLE';

        $name = sprintf('`%s`', $this->getName());
        if ($this->hasDatabaseName()) {
            $name = sprintf('`%s`.', $this->getDatabaseName()) . $name;
        }
        $build[] = $name;

        return implode(' ', $build);
    }
}
