<?php

namespace DBClass\MySQL;

final class DropDatabase implements Interfaces\DDLStatement
{
    private $databaseName;
    private $ifExists = false;

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

    public function setIfExists(bool $value = true): self
    {
        $this->ifExists = $value;
        return $this;
    }

    public function getIfExists(): bool
    {
        return $this->ifExists;
    }

    public function getBuild(): string
    {
        $build[] = 'DROP DATABASE';

        if ($this->getIfExists()) {
            $build[] = 'IF EXISTS';
        }

        $build[] = sprintf('`%s`', $this->getDatabaseName());

        return implode(' ', $build);
    }
}
