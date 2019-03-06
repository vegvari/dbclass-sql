<?php

namespace DBClass\SQL\MySQL;

final class CreateDatabase implements Interfaces\CreateDatabase
{
    private $database;
    private $charset = self::DEFAULT_CHARSET;
    private $collation = self::DEFAULT_COLLATION;
    private $if_not_exists = false;

    public function __construct(string $database, string $charset = null, string $collation = null)
    {
        $this->setDatabase($database);
        $this->setCharset($charset);
        $this->setCollation($collation);
    }

    public function setDatabase(string $database): Interfaces\CreateDatabase
    {
        $this->database = $database;
        return $this;
    }

    public function getDatabase(): string
    {
        return $this->database;
    }

    public function setCharset(?string $charset = null): Interfaces\CreateDatabase
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

    public function setCollation(?string $collation = null): Interfaces\CreateDatabase
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

    public function ifExists(): Interfaces\CreateDatabase
    {
        $this->if_not_exists = false;
        return $this;
    }

    public function ifNotExists(): Interfaces\CreateDatabase
    {
        $this->if_not_exists = true;
        return $this;
    }

    public function build(): string
    {
        $build[] = 'CREATE DATABASE';

        if ($this->if_not_exists === true) {
            $build[] = 'IF NOT EXISTS';
        }

        $build[] = sprintf('`%s`', $this->getDatabase());
        $build[] = sprintf('CHARACTER SET `%s`', $this->getCharset());
        $build[] = sprintf('COLLATE `%s`', $this->getCollation());

        return implode(' ', $build) . ';';
    }
}
