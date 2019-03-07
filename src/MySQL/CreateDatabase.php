<?php

namespace DBClass\SQL\MySQL;

final class CreateDatabase implements Interfaces\CreateDatabase
{
    private $build = '';
    private $data = [];

    private $name;
    private $if_not_exists = false;
    private $charset = self::DEFAULT_CHARSET;
    private $collation = self::DEFAULT_COLLATION;

    public function __construct(string $name)
    {
        $this->setName($name);
    }

    public function setName(string $name): Interfaces\CreateDatabase
    {
        $this->name = $name;
        return $this->build();
    }

    public function getName(): string
    {
        return $this->name;
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

        $build[] = sprintf('`%s`', $this->getName());
        $build[] = sprintf('CHARACTER SET `%s`', $this->getCharset());
        $build[] = sprintf('COLLATE `%s`', $this->getCollation());

        $this->build = implode(' ', $build) . ';';
        return $this;
    }
}
