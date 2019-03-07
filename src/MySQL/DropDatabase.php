<?php

namespace DBClass\SQL\MySQL;

final class DropDatabase implements Interfaces\DropDatabase
{
    private $name;
    private $exists = false;

    public function __construct(string $name)
    {
        $this->setName($name);
    }

    public function setName(string $name): Interfaces\DropDatabase
    {
        $this->name = $name;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function ifExists(): Interfaces\DropDatabase
    {
        $this->exists = true;
        return $this;
    }

    public function ifNotExists(): Interfaces\DropDatabase
    {
        $this->exists = false;
        return $this;
    }

    public function getBuild(): string
    {
        $build[] = 'DROP DATABASE';

        if ($this->exists === true) {
            $build[] = 'IF EXISTS';
        }

        $build[] = sprintf('`%s`', $this->getName());

        return implode(' ', $build) . ';';
    }

    public function getData(): array
    {
        return [];
    }
}
