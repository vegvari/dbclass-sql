<?php

namespace DBClass\SQL\MySQL;

final class CreateTable implements Interfaces\CreateTable
{
    private $build = '';
    private $data = [];

    private $name;
    private $charset = self::DEFAULT_CHARSET;
    private $collation = self::DEFAULT_COLLATION;
    private $if_not_exists = false;

    public function __construct(string $name, string $charset = null, string $collation = null)
    {
        $this->setName($name);
        $this->setCharset($charset);
        $this->setCollation($collation);
        $this->build();
    }

    public function setName(string $name): Interfaces\CreateTable
    {
        $this->name = $name;
        return $this->build();
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setCharset(string $charset = null): Interfaces\CreateTable
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

    public function setCollation(string $collation = null): Interfaces\CreateTable
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

    public function ifExists(): Interfaces\CreateTable
    {
        $this->if_not_exists = false;
        return $this->build();
    }

    public function ifNotExists(): Interfaces\CreateTable
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
        $build[] = 'CREATE TABLE';

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
