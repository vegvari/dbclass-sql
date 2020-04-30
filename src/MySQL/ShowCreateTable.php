<?php

namespace DBClass\MySQL;

final class ShowCreateTable implements Interfaces\DDLStatement
{
    private $databaseName;
    private $tableName;
    private $ifExists = false;

    public function __construct(string $tableName)
    {
        $this->tableName = $tableName;
    }

    public function setDatabaseName(?string $databaseName = null): self
    {
        $this->databaseName = $databaseName;
        return $this;
    }

    public function getDatabaseName(): string
    {
        return $this->databaseName;
    }

    public function hasDatabaseName(): bool
    {
        return $this->databaseName !== null;
    }

    public function getTableName(): string
    {
        return $this->tableName;
    }

    public function getName(): string
    {
        return $this->tableName;
    }

    public function getBuild(): string
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
