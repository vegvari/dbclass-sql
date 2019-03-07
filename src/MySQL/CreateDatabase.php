<?php

namespace DBClass\SQL\MySQL;

final class CreateDatabase implements Interfaces\CreateDatabase
{
    private $name;
    private $exists = true;
    private $charset = self::DEFAULT_CHARSET;
    private $collation = self::DEFAULT_COLLATION;

    public function __construct(string $name)
    {
        $this->setName($name);
    }

    public function setName(string $name): Interfaces\CreateDatabase
    {
        $this->name = $name;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function ifExists(): Interfaces\CreateDatabase
    {
        $this->exists = true;
        return $this;
    }

    public function ifNotExists(): Interfaces\CreateDatabase
    {
        $this->exists = false;
        return $this;
    }

    public function setCharset(string $charset = null): Interfaces\CreateDatabase
    {
        if ($charset === null) {
            $charset = self::DEFAULT_CHARSET;
        }

        $this->charset = $charset;
        return $this;
    }

    public function getCharset(): string
    {
        return $this->charset;
    }

    public function setCollation(string $collation = null): Interfaces\CreateDatabase
    {
        if ($collation === null) {
            $collation = self::DEFAULT_COLLATION;
        }

        $this->collation = $collation;
        return $this;
    }

    public function getCollation(): string
    {
        return $this->collation;
    }

    public function getBuild(): string
    {
        $build[] = 'CREATE DATABASE';

        if ($this->exists === false) {
            $build[] = 'IF NOT EXISTS';
        }

        $build[] = sprintf('`%s`', $this->getName());
        $build[] = sprintf('CHARACTER SET `%s`', $this->getCharset());
        $build[] = sprintf('COLLATE `%s`', $this->getCollation());

        return implode(' ', $build) . ';';
    }

    public function getData(): array
    {
        return [];
    }
}
