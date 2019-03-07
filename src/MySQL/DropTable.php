<?php

namespace DBClass\SQL\MySQL;

final class DropTable implements Interfaces\DropTable
{
    private $name;
    private $if_exists = false;

    public function __construct(string $name)
    {
        $this->setName($name);
    }

    public function setName(string $name): Interfaces\DropTable
    {
        $this->name = $name;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function ifExists(): Interfaces\DropTable
    {
        $this->if_exists = true;
        return $this;
    }

    public function ifNotExists(): Interfaces\DropTable
    {
        $this->if_exists = false;
        return $this;
    }

    public function getBuild(): string
    {
        $build[] = 'DROP TABLE';

        if ($this->if_exists === true) {
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
