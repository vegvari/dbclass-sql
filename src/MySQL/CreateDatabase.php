<?php

namespace DBClass\SQL\MySQL;

final class CreateDatabase implements Interfaces\CreateDatabase
{
    private $build = '';
    private $data = [];

    private $database;
    private $charset = self::DEFAULT_CHARSET;
    private $collation = self::DEFAULT_COLLATION;
    private $if_not_exists = false;

    public function __construct(string $database, string $charset = null, string $collation = null)
    {
        $this->setDatabase($database);
        $this->setCharset($charset);
        $this->setCollation($collation);
        $this->build();
    }

    public function setDatabase(string $database): Interfaces\CreateDatabase
    {
        $this->database = $database;
        return $this->build();
    }

    public function getDatabase(): string
    {
        return $this->database;
    }

    public function setCharset(string $charset = null): Interfaces\CreateDatabase
    {
        if ($charset === null) {
            $charset = self::DEFAULT_CHARSET;
        }

        $this->charset = $charset;
        return $this->build();
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
        return $this->build();
    }

    public function getCollation(): string
    {
        return $this->collation;
    }

    public function ifExists(): Interfaces\CreateDatabase
    {
        $this->if_not_exists = false;
        return $this->build();
    }

    public function ifNotExists(): Interfaces\CreateDatabase
    {
        $this->if_not_exists = true;
        return $this->build();
    }

    public function getBuild(): string
    {
        return $this->build;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function __toString(): string
    {
        return $this->build;
    }

    private function build(): self
    {
        $build[] = 'CREATE DATABASE';

        if ($this->if_not_exists === true) {
            $build[] = 'IF NOT EXISTS';
        }

        $build[] = sprintf('`%s`', $this->getDatabase());
        $build[] = sprintf('CHARACTER SET `%s`', $this->getCharset());
        $build[] = sprintf('COLLATE `%s`', $this->getCollation());

        $this->build = implode(' ', $build) . ';';
        return $this;
    }
}
