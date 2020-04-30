<?php

namespace DBClass\MySQL;

class CreateDatabase implements Interfaces\DDLStatement
{
    private $databaseName;
    private $ifNotExists = false;
    private $charset = self::DEFAULT_CHARSET;
    private $collation = self::DEFAULT_COLLATION;

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

    final public function setIfNotExists(bool $value = true): self
    {
        $this->ifNotExists = $value;
        return $this;
    }

    final public function getIfNotExists(): bool
    {
        return $this->ifNotExists;
    }

    final public function setCharset(string $charset = self::DEFAULT_CHARSET): self
    {
        $this->charset = $charset;
        return $this;
    }

    final public function getCharset(): string
    {
        return $this->charset;
    }

    final public function setCollation(string $collation = self::DEFAULT_COLLATION): self
    {
        $this->collation = $collation;
        return $this;
    }

    final public function getCollation(): string
    {
        return $this->collation;
    }

    final public function getBuild(): string
    {
        $build[] = 'CREATE DATABASE';

        if ($this->getIfNotExists()) {
            $build[] = '/*!32312 IF NOT EXISTS*/';
        }

        $build[] = sprintf('`%s`', $this->getDatabaseName());
        $build[] = sprintf('/*!40100 DEFAULT CHARACTER SET %s', $this->getCharset());
        $build[] = sprintf('COLLATE %s */', $this->getCollation());

        return implode(' ', $build);
    }
}
